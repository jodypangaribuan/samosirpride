<?php
include "koneksi.php";
session_start();

// Proses hapus data
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    if ($id > 0) {
        $query = "SELECT gambar FROM struktur_gereja WHERE id = $id";
        $img_result = mysqli_query($conn, $query);

        if ($img_data = mysqli_fetch_assoc($img_result)) {
            $stmt = $conn->prepare("DELETE FROM struktur_gereja WHERE id = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                $file_path = "uploads/struktur_gereja/" . $img_data['gambar'];
                if (!empty($img_data['gambar']) && file_exists($file_path)) {
                    unlink($file_path);
                }
                header("Location: struktur_gereja.php?status=success&message=" . urlencode("Struktur Gereja berhasil dihapus"));
                exit;
            } else {
                die("Gagal menghapus data: " . $stmt->error);
            }
        } else {
            header("Location: struktur_gereja.php?status=error&message=" . urlencode("Data tidak ditemukan"));
            exit;
        }
    } else {
        header("Location: struktur_gereja.php?status=error&message=" . urlencode("ID tidak valid"));
        exit;
    }
}

// Ambil semua kategori dari tabel kategori_struktur_gereja
$kategori_list = [];
$kategori_query = mysqli_query($conn, "SELECT id, nama_kategori FROM kategori_struktur_gereja ORDER BY id asc");
while ($row = mysqli_fetch_assoc($kategori_query)) {
    $kategori_list[$row['id']] = $row['nama_kategori'];
}

// Ambil data struktur gereja per kategori
$data_kategori = [];
foreach ($kategori_list as $kategori_id => $nama_kategori) {
    $stmt = $conn->prepare("
        SELECT sg.*, ksg.nama_kategori
        FROM struktur_gereja sg
        JOIN kategori_struktur_gereja ksg ON sg.kategori_id = ksg.id
        WHERE sg.kategori_id = ?
        ORDER BY sg.id DESC
    ");
    $stmt->bind_param("i", $kategori_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data_kategori[$nama_kategori] = $result->fetch_all(MYSQLI_ASSOC);
}

$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Gereja - Galeri</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Merriweather:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            /* Adjust grid for single or multiple images */
            gap: 30px;
            justify-content: center;
            /* Center-align the grid */
            margin-top: 20px;
        }

        .gallery-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            max-width: 300px;
            /* Ensure consistent size for single images */
            margin: 0 auto;
            /* Center-align single images */
        }

        .gallery-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .image-placeholder {
            width: 100%;
            height: 250px;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .gallery-caption {
            padding: 10px 15px;
        }

        .gallery-title {
            font-size: 16px;
            font-weight: bold;
            margin: 8px 0 5px;
        }

        .gallery-description {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .gallery-actions {
            margin-bottom: 15px;
        }

        .btn-edit,
        .btn-delete {
            background: #007bff;
            border: none;
            padding: 8px 12px;
            color: white;
            font-size: 14px;
            margin: 3px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-delete {
            background: #dc3545;
        }

        .btn-edit:hover,
        .btn-delete:hover {
            opacity: 0.8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .gallery-grid {
                grid-template-columns: 1fr;
            }
        }

        .category-title {
            text-align: center;
            /* Center-align the category title */
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Align menu and search bar with logo */
        .header-navigation-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
        }

        .site-logo {
            flex-shrink: 0;
        }

        .header-navigation {
            flex-grow: 1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .header-navigation ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 20px;
        }

        .header-navigation li {
            position: relative;
        }

        .header-navigation li a {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .header-navigation li a:hover {
            color: #0066cc;
        }

        /* Search box styling */
        .menu-search {
            position: relative;
            margin-left: 20px;
            display: flex;
            align-items: center;
        }

        .search-box {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .search-box.active {
            display: block;
        }

        .search-btn {
            cursor: pointer;
            font-size: 18px;
            color: #333;
            transition: color 0.3s;
            padding: 10px 15px;
        }

        .search-btn:hover {
            color: #0066cc;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include "../templates/sidebar.php"; ?>
        <!-- Content Area -->
        <div class="content">
            <div class="content-header">
                <h1>Kelola Struktur Gereja</h1>
                <div class="user-info">
                    <span>Selamat datang, Admin</span>
                </div>
            </div>

            <div class="main-content">
                <div class="section-header">
                    <h2 class="section-title">Dokumentasi Struktur Gereja HKBP Tiberias</h2>
                    <a href="tambah_struktur_gereja.php" class="btn btn-primary btn-tambah">
                        <i class="fas fa-plus"></i> Tambahkan Struktur Gereja
                    </a>
                </div>

                <?php foreach ($data_kategori as $kategori_nama => $struktur_items): ?>
                    <div class="category-section">
                        <h3 class="category-title"><?= htmlspecialchars($kategori_nama) ?></h3>
                        <div class="gallery-grid">
                            <?php if (!empty($struktur_items)): ?>
                                <?php foreach ($struktur_items as $row): ?>
                                    <div class="gallery-card">
                                        <?php
                                        $imagePath = "uploads/struktur_gereja/" . htmlspecialchars($row['gambar']);
                                        if (!empty($row['gambar']) && file_exists($imagePath)) {
                                            echo '<img src="' . $imagePath . '" alt="' . htmlspecialchars($row['nama']) . '" class="gallery-image">';
                                        } else {
                                            echo '<div class="image-placeholder">
                                                <i class="fas fa-image fa-3x"></i>
                                                <p>Gambar tidak ditemukan</p>
                                            </div>';
                                        }
                                        ?>
                                        <div class="gallery-caption">
                                            <h3 class="gallery-title"><?= htmlspecialchars($row['nama']) ?></h3>
                                            <p class="gallery-description"><?= htmlspecialchars($row['deskripsi']) ?></p>
                                            <p class="gallery-category">Kategori: <?= htmlspecialchars($row['nama_kategori']) ?></p>
                                        </div>
                                        <div class="gallery-actions">
                                            <button class="btn-edit"
                                                onclick="window.location.href='edit_struktur_gereja.php?id=<?= $row['id'] ?>'">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button class="btn-delete" onclick="confirmDelete(<?= $row['id'] ?>)">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Tidak ada data untuk kategori ini.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus struktur gereja ini?')) {
                window.location.href = 'struktur_gereja.php?action=delete&id=' + id;
            }
        }
    </script>

</body>

</html>
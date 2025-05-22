<?php
include "koneksi.php";

// Proses hapus data jika action = delete dan id tersedia
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Cek apakah ID valid
    if ($id > 0) {
        // Ambil nama file gambar sebelum hapus dari database
        $query = "SELECT gambar FROM acara_koor WHERE id = $id";
        $img_result = mysqli_query($conn, $query);

        if ($img_data = mysqli_fetch_assoc($img_result)) {
            $stmt = $conn->prepare("DELETE FROM acara_koor WHERE id = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                // Hapus file gambar dari folder uploads
                if (!empty($img_data['gambar']) && file_exists("uploads/acara_koor" . $img_data['gambar'])) {
                    unlink("uploads/acara_koor" . $img_data['gambar']);
                }
                header("Location: acara_koor.php?status=success&message=" . urlencode("Acara Koor berhasil dihapus"));
                exit;
            } else {
                die("Gagal menghapus data: " . $stmt->error);
            }
        } else {
            header("Location: acara_koor.php?status=error&message=" . urlencode("Data tidak ditemukan"));
            exit;
        }
    } else {
        header("Location: acara_koor.php?status=error&message=" . urlencode("ID tidak valid"));
        exit;
    }
}

// Ambil semua data event acara koor
$result = mysqli_query($conn, "SELECT * FROM acara_koor ORDER BY id DESC");

// Cek halaman aktif
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
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-top: 20px;
}

.gallery-card {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
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

.btn-edit, .btn-delete {
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

.btn-edit:hover, .btn-delete:hover {
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

        </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include "../templates/sidebar.php"; ?>
        <!-- Content Area -->
        <div class="content">
            <div class="content-header">
                <h1>Kelola Acara Koor</h1>
                <div class="user-info">
                    <span>Selamat datang, Admin</span>
                </div>
            </div>

            <div class="main-content">
                <div class="section-header">
                    <h2 class="section-title">Dokumentasi Kegiatan HKBP Tiberias</h2>
                    <a href="tambah_acara_koor.php" class="btn btn-primary btn-tambah">
                        <i class="fas fa-plus"></i> Tambahkan Dokumentasi Koor
                    </a>
                </div>

                <div class="gallery-grid">
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <div class="gallery-card">
                                <?php
                                $imagePath = "uploads/acara_koor" . htmlspecialchars($row['gambar']);
                                if (!empty($row['gambar']) && file_exists($imagePath)) {
                                    echo '<img src="'.$imagePath.'" alt="'.htmlspecialchars($row['nama']).'" class="gallery-image">';
                                } else {
                                    echo '<div class="image-placeholder">
                                        <i class="fas fa-image fa-3x"></i>
                                        <p>Gambar tidak ditemukan</p>
                                    </div>';
                                }
                                ?>
                                <div class="gallery-caption">
                                    <h3 class="gallery-title"><?php echo htmlspecialchars($row['nama']); ?></h3>
                                </div>
                                <div class="gallery-actions">
                                    <button class="btn-edit" onclick="window.location.href='edit_acara_koor.php?id=<?php echo $row['id']; ?>'">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn-delete" onclick="confirmDelete(<?php echo $row['id']; ?>)">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>Belum ada galeri ditambahkan.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan skrip confirm delete di bawah sini -->
    <script>
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus galeri ini?')) {
            window.location.href = 'acara_koor.php?action=delete&id=' + id;
        }
    }
    </script>
</body>
</html>
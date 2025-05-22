<?php
include "koneksi.php";
session_start(); // Tambahkan ini kalau session belum dimulai

// Ambil data koor
$result = mysqli_query($conn, "SELECT * FROM kategori_struktur_gereja ORDER BY id DESC");

// Handle hapus data
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM kategori_struktur_gereja WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: kategori_struktur_gereja.php?status=deleted");
        exit;
    } else {
        die("Error menghapus data: " . $stmt->error);
    }
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
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Adjust grid for single or multiple images */
    gap: 30px;
    justify-content: center; /* Center-align the grid */
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
    max-width: 300px; /* Ensure consistent size for single images */
    margin: 0 auto; /* Center-align single images */
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

.category-title {
    text-align: center; /* Center-align the category title */
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
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
                <h1>Kelola Kategori Struktur Gereja</h1>
                <div class="user-info">
                    <span>Selamat datang, Admin</span>
                </div>
            </div>

            <div class="main-content" style="margin-top: 1.5rem;">
                <h2 class="section-title">Daftar Kategori Struktur Gereja</h2>

                <a href="tambah_kategori_struktur_gereja.php" class="btn btn-primary btn-tambah">
                    <i class="fas fa-plus"></i> Tambahkan Kategori Struktur Gereja
                </a>

                <div class="table-container" style="margin-top: 20px;">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama kategori</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            mysqli_data_seek($result, 0);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['nama_kategori']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
                                echo "<td>";
                                echo "<a href='edit_kategori_struktur_gereja.php?id=" . $row['id'] . "' class='btn btn-sm btn-edit'><i class='fas fa-edit'></i></a> ";
                                echo "<button onclick='confirmDelete(" . $row['id'] . ")' class='btn btn-sm btn-delete'><i class='fas fa-trash'></i></button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus dokumentasi kategori_struktur_gereja ini?')) {
                window.location.href = 'kategori_struktur_gereja.php?action=delete&id=' + id;
            }
        }
    </script>
</body>

</html>
<?php
include "koneksi.php";
session_start(); // Tambahkan ini kalau session belum dimulai

// Ambil data koor
$result = mysqli_query($conn, "SELECT * FROM koor ORDER BY id DESC");

// Handle hapus data
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM koor WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: koor.php?status=deleted");
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
</head>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include "../templates/sidebar.php"; ?>
        <!-- Content Area -->
        <div class="content">
            <div class="content-header">
                <h1>Kelola Koor</h1>
                <div class="user-info">
                    <span>Selamat datang, <?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
                </div>
            </div>

            <div class="main-content" style="margin-top: 1.5rem;">
                <h2 class="section-title">Daftar Jadwal Koor</h2>

                <a href="tambah_koor.php" class="btn btn-primary btn-tambah">
                    <i class="fas fa-plus"></i> Tambahkan Jadwal
                </a>

                <div class="table-container" style="margin-top: 20px;">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tempat</th>
                                <th>Waktu Latihan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            mysqli_data_seek($result, 0);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['tempat']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['waktu_latihan']) . "</td>";
                                echo "<td>";
                                echo "<a href='edit_koor.php?id=" . $row['id'] . "' class='btn btn-sm btn-edit'><i class='fas fa-edit'></i></a> ";
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
            if (confirm('Apakah Anda yakin ingin menghapus dokumentasi koor ini?')) {
                window.location.href = 'koor.php?action=delete&id=' + id;
            }
        }
    </script>
    </body>

</html>
<?php
session_start();
include "koneksi.php";

// Pastikan user login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Proses hapus data jika action = delete dan id tersedia
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Cek apakah ID valid
    if ($id > 0) {
        // Ambil nama file PDF sebelum hapus dari database
        $query = "SELECT file_pdf FROM warta_jemaat WHERE id = $id AND user_id = '$user_id'";
        $file_result = mysqli_query($conn, $query);

        if ($file_data = mysqli_fetch_assoc($file_result)) {
            $stmt = $conn->prepare("DELETE FROM warta_jemaat WHERE id = ? AND user_id = ?");
            $stmt->bind_param("ii", $id, $user_id);

            if ($stmt->execute()) {
                // Hapus file PDF dari folder uploads
                $file_path = "uploads/warta_jemaat/" . $file_data['file_pdf'];
                if (!empty($file_data['file_pdf']) && file_exists($file_path)) {
                    unlink($file_path);
                }
                header("Location: warta_jemaat.php?status=success&message=" . urlencode("Warta Jemaat berhasil dihapus"));
                exit;
            } else {
                die("Gagal menghapus data: " . $stmt->error);
            }
        } else {
            header("Location: warta_jemaat.php?status=error&message=" . urlencode("Data tidak ditemukan"));
            exit;
        }
    } else {
        header("Location: warta_jemaat.php?status=error&message=" . urlencode("ID tidak valid"));
        exit;
    }
}

$query = "SELECT * FROM warta_jemaat WHERE user_id = '$user_id' ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Gereja - Warta Jemaat</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Merriweather:wght@400;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include "../templates/sidebar.php"; ?>
        <!-- Content Area -->
        <div class="content">
            <div class="content-header">
                <h1>Kelola Warta Jemaat</h1>
                <div class="user-info">
                    <span>Selamat datang, Admin</span>
                </div>
            </div>

            <div class="main-content">
                <h2 class="section-title">Daftar Warta Jemaat</h2>
                <a href="tambah_warta_jemaat.php" class="btn btn-primary">+Tambahkan Warta Jemaat</a>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Keterangan</th>
                                <th>FILE PDF</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php $id = 1; ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?= $id++; ?></td>
                                        <td><?= htmlspecialchars($row['judul']); ?></td>
                                        <td><?= htmlspecialchars($row['keterangan']); ?></td>
                                        <td>
                                            <?php if (!empty($row['file_pdf'])): ?>
                                                <a href="uploads/warta_jemaat/<?= htmlspecialchars($row['file_pdf']); ?>"
                                                    target="_blank">Lihat PDF</a>
                                            <?php else: ?>
                                                Tidak ada
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-sm btn-view"
                                                    onclick="window.location.href='edit_warta_jemaat.php?id=<?= $row['id']; ?>'">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-delete"
                                                    onclick="confirmDelete(<?= $row['id']; ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">Tidak ada data warta jemaat.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function confirmDelete(id) {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            window.location.href = "warta_jemaat.php?action=delete&id=" + id;
        }
    }
</script>

</html>
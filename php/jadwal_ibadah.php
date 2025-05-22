<?php
include "koneksi.php";
$result = mysqli_query($conn, "SELECT * FROM jadwal_ibadah ORDER BY id DESC");
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM jadwal_ibadah WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: jadwal_ibadah.php?status=deleted");
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
    <title>Admin Panel Gereja - Jadwal Ibadah</title>
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
        </nav>
        <!-- Content Area -->
        <div class="content">
            <div class="content-header">
                <h1>Kelola Jadwal Ibadah</h1>
                <div class="user-info">
                    <span>Selamat datang, Admin</span>
                </div>
            </div>


            <!-- Daftar Ayat Harian -->
            <div class="main-content" style="margin-top: 1.5rem;">
                <h2 class="section-title">Daftar Jadwal Ibadah</h2>
                <a href="tambah_jadwal_ibadah.php" class="btn btn-primary" style="padding: 8px 12px; background-color: #007bff; color: white; border-radius: 5px; text-decoration: none;">
        <i class="fas fa-plus"></i> Tambahkan Jadwal Ibadah
    </a>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Ibadah</th>
                                <th>Hari</th>
                                <th>Waktu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php $id = 1; ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $id++; ?></td>
                                        <td><?php echo htmlspecialchars($row['ibadah']); ?></td>
                                        <td><?php echo htmlspecialchars($row['hari']); ?></td>
                                        <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-sm btn-view"
                                                    onclick="window.location.href='edit_jadwal_ibadah.php?id=<?php echo $row['id']; ?>'">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                               
                                                <button class="btn btn-sm btn-delete"
                                                    onclick="confirmDelete(<?php echo $row['id']; ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align: center;">Belum ada data Jadwal Ibadah</td>
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
        if (confirm('Apakah Anda yakin ingin menghapus Jadwal Ibadah ini?')) {
            // Redirect ke halaman PHP dengan parameter untuk menghapus
            window.location.href = 'jadwal_ibadah.php?action=delete&id=' + id;
        }
    }
</script>

</html>
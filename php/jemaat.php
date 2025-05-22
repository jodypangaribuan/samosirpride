<?php
include "koneksi.php";
$result = mysqli_query($conn, "SELECT * FROM jemaat ORDER BY id DESC");
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM jemaat WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: jemaat.php?status=deleted");
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
    <title>Admin Panel Gereja - jadwal ibadah</title>
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
                <h1>Kelola Jemaat</h1>
                <div class="user-info">
                    <span>Selamat datang, Admin</span>
                </div>
            </div>


            <!-- Daftar Ayat Harian -->
            <div class="main-content" style="margin-top: 1.5rem;">
                <h2 class="section-title">Daftar Jemaat</h2>
                <a href="tambah_jemaat.php" class="btn btn-primary"
                    style="padding: 8px 12px; background-color: #007bff; color: white; border-radius: 5px; text-decoration: none;">
                    <i class="fas fa-plus"></i> Tambahkan Data Jemaat
                </a>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Nomor Telepon</th>

                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php $id = 1; ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $id++; ?></td>
                                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                        <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                                        <td><?php echo htmlspecialchars($row['tempat_lahir']); ?></td>
                                        <td><?php echo htmlspecialchars($row['tanggal_lahir']); ?></td>
                                        <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nomor_telepon']); ?></td>

                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-sm btn-view"
                                                    onclick="window.location.href='edit_jemaat.php?id=<?php echo $row['id']; ?>'">
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
                                    <td colspan="5" style="text-align: center;">Belum ada data jemaat</td>
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
        if (confirm('Apakah Anda yakin ingin menghapus data jemaat ini?')) {
            // Redirect ke halaman PHP dengan parameter untuk menghapus
            window.location.href = 'jemaat.php?action=delete&id=' + id;
        }
    }
</script>

</html>
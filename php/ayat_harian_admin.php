x<?php
include "koneksi.php";
$result = mysqli_query($conn, "SELECT a.*, u.username as admin_name 
                              FROM ayat_harian a 
                              JOIN users u ON a.user_id = u.id 
                              ORDER BY a.id DESC");

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM ayat_harian WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ayat_harian_admin.php?status=deleted");
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
    <title>Admin Panel Gereja - Ayat Harian</title>
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
        <?php include "../templates/sidebar.php"; ?>
        <!-- Content Area -->
        <div class="content">
            <div class="content-header">
                <h1>Pengelolaan Ayat Harian</h1>
                <div class="user-info">
                    <span>Selamat datang, Admin</span>
                </div>
            </div>


            <!-- Daftar Ayat Harian -->
            <div class="main-content" style="margin-top: 1.5rem;">
                <h2 class="section-title">Daftar Ayat Harian</h2>
                <a href="tambah_ayat_harian.php" class="btn btn-primary btn-tambah">
                    <i class="fas fa-plus"></i> Tambahkan Ayat Harian
                </a>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Referensi</th>
                                <th>Ayat</th>
                                <th>Penginput</th>
                                <th style="padding-left: 60px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1; ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo date('d M Y', strtotime($row['tanggal_dibuat'])); ?></td>
                                        <td><?php echo htmlspecialchars($row['referensi']); ?></td>
                                        <td><?php echo htmlspecialchars($row['ayat']); ?></td>
                                        <td><?php echo htmlspecialchars($row['admin_name']); ?></td>
                                        <td>
                                                <button class="btn btn-sm btn-view"
                                                    onclick="window.location.href='edit_ayat_harian.php?id=<?php echo $row['id']; ?>'">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-delete"
                                                    onclick="confirmDelete(<?php echo $row['id']; ?>)">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="text-align: center;">Belum ada data ayat</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah anda yakin ingin menghapus ayat ini?')) {
                window.location.href = 'ayat_harian_admin.php?action=delete&id=' + id;
            }
        }
    </script>
</body>
</html>
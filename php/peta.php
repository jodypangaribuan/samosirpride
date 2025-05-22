<?php
include "koneksi.php";
$result = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM galeri WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: galeri.php?status=deleted");
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

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <i class="fas fa-church fa-2x"></i>
                <h3>Admin Gereja</h3>
            </div>
            <ul class="sidebar-menu">
                <li>
                    <a href="dashboard.php" class="<?= ($current_page == 'dashboard.php') ? 'active' : '' ?>">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="ayat_harian_Admin.php" class="<?= ($current_page == 'ayat_harian_admin.php') ? 'active' : '' ?>">
                        <i class="fas fa-book-bible"></i> Ayat Harian
                    </a>
                </li>
                <li>
                    <a href="jadwal_ibadah.php" class="<?= ($current_page == 'jadwal_ibadah.php') ? 'active' : '' ?>">
                        <i class="fas fa-calendar-alt"></i> Jadwal Ibadah
                    </a>
                </li>
                <li>
                    <a href="program_pelayanan.php" class="<?= ($current_page == 'program_pelayanan.php') ? 'active' : '' ?>">
                    <i class="fas fa-solid fa-folder "></i> Program Pelayanan
                    </a>
                </li>
                <li>
                    <a href="galeri.php" class="<?= ($current_page == 'galeri.php') ? 'active' : '' ?>">
                    <i class="fas  fa-light fa-file "></i>Galeri
                    </a>
                </li>
                <li>
                    <a href="jemaat.php" class="<?= ($current_page == 'jemaat.php') ? 'active' : '' ?>">
                    <i class="fas fa-users"></i>Jemaat
                    </a>
                </li>
                <li>
                    <a href="warta_jemaat.php" class="<?= ($current_page == 'warta_jemaat.php') ? 'active' : '' ?>">
                    <i class="fas fa-solid fa-address-book"></i>Warta Jemaat
                    </a>
                </li>
                <li>
                    <a href="struktur_gereja.php" class="<?= ($current_page == 'struktur_gereja.php') ? 'active' : '' ?>">
                    <i class="fas fa-solid fa-landmark"></i>Struktur Gereja
                    </a>
                </li>
                <li>
                    <a href="koor.php" class="<?= ($current_page == 'koor.php') ? 'active' : '' ?>">
                    <i class="fas fa-solid fa-folder"></i>Koor
                    </a>
                </li>
                <li>
                    <a href="acara_koor.php" class="<?= ($current_page == 'acara_koor.php') ? 'active' : '' ?>">
                    <i class="fas fa-solid fa-folder"></i>Acara Koor
                    </a>
                </li>
                <li>
                    <a href="event_galeri.php" class="<?= ($current_page == 'event_galeri.php') ? 'active' : '' ?>">
                    <i class="fas fa-solid fa-folder"></i>Event Galeri
                    </a>
                </li>
                <li>
                    <a href="remaja_naposo.php" class="<?= ($current_page == 'remaja_naposo.php') ? 'active' : '' ?>">
                    <i class="fas fa-solid fa-folder"></i>Remaja Naposo
                    </a>
                </li>
                <li>
                    <a href="peta.php" class="<?= ($current_page == 'peta.php') ? 'active' : '' ?>">
                    <i class="fas fa-solid fa-location-dot"></i>peta/maps
                    </a>
                </li>
                <li>
                    <a href="pengaturan.php" class="<?= ($current_page == 'pengaturan.php') ? 'active' : '' ?>">
                        <i class="fas fa-cog"></i> Pengaturan
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                </li>
            </ul>

        </nav>
        <!-- Content Area -->
        <div class="content">
            <div class="content-header">
                <h1>Kelola Warta Jemaat</h1>
                <div class="user-info">
                    <span>Selamat datang, Admin</span>
                </div>
            </div>


            <!-- Daftar Ayat Harian -->
            <div class="main-content" style="margin-top: 1.5rem;">
                <h2 class="section-title">Daftar Galeri</h2>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nama Event</th>
                                <th>deskripsi</th>
                                <th>gambar</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php $id = 1; ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $id++; ?></td>
                                        <td><?php echo htmlspecialchars($row['nama_event']); ?></td>
                                        <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                                        <td><?php echo htmlspecialchars($row['gambar']); ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-sm btn-view"
                                                    onclick="window.location.href='edit_galeri.php?id=<?php echo $row['id']; ?>'">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-add"
                                                    onclick="window.location.href='tambah_galeri.php'">
                                                    <i class="fas fa-plus"></i>
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
                                    <td colspan="5" style="text-align: center;">Belum ada galeri di tambah</td>
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
        if (confirm('Apakah Anda yakin ingin menghapus ayat ini?')) {
            // Redirect ke halaman PHP dengan parameter untuk menghapus
            window.location.href = 'galeri.php?action=delete&id=' + id;
        }
    }
</script>

</html>
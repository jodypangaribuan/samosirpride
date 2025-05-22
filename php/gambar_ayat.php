<?php
include "koneksi.php";
$result = mysqli_query($conn, "SELECT g.*, u.username as admin_name 
                              FROM gambar_ayat g 
                              JOIN users u ON g.user_id = u.id 
                              ORDER BY g.id DESC");

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Hapus file gambar terlebih dahulu
    $query = "SELECT gambar FROM gambar_ayat WHERE id = $id";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($res);
    if ($row && file_exists($row['gambar'])) {
        unlink($row['gambar']);
    }

    $stmt = $conn->prepare("DELETE FROM gambar_ayat WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: gambar_ayat.php?status=success&message=Gambar ayat berhasil dihapus");
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
        <style>
        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .gallery-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .gallery-info {
            padding: 15px;
        }
        .gallery-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
    </style>
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
                    <a href="gambar_ayat.php" class="<?= ($current_page == 'gambar_ayat.php') ? 'active' : '' ?>">
                        <i class="fas fa-book-bible"></i> Gambar Ayat Harian
                    </a>
                </li>
                <li>
                    <a href="ayat_harian.php" class="<?= ($current_page == 'ayat_harian.php') ? 'active' : '' ?>">
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
                    <a href="kategori_struktur_gereja.php" class="<?= ($current_page == 'kategori_struktur_gereja.php') ? 'active' : '' ?>">
                    <i class="fas fa-solid fa-landmark"></i>kategori struktur gereja
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
                <h1>Kelola Gambar Ayat</h1>
                <div class="user-info">
                    <span>Selamat datang, Admin</span>
                </div>
            </div>

            <div class="main-content" style="margin-top: 1.5rem;">
                <h2 class="section-title">Daftar Gambar Ayat</h2>

                <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                    <div class="alert alert-success">
                        <?php echo htmlspecialchars($_GET['message']); ?>
                    </div>
                <?php endif; ?>

                

<div class="gallery-container">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="Gambar Ayat">
            <div class="gallery-item">
                
                <?php printf ($row['gambar']);?>
                <div class="gallery-info">
                    <h4><?php echo htmlspecialchars($row['referensi']); ?></h4>
                    <p>Ditambahkan oleh: <?php echo htmlspecialchars($row['admin_name']); ?></p>
                    <p>Tanggal: 
                        <?php 
                            if (isset($row['tanggal_dibuat']) && !empty($row['tanggal_dibuat'])) {
                                echo date('d M Y', strtotime($row['tanggal_dibuat']));
                            } else {
                                echo 'Tanggal tidak tersedia';
                            }
                        ?>
                    </p>
                    <div class="gallery-actions">
                        <a href="edit_gambar_ayat.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="javascript:void(0);" class="btn btn-sm btn-delete" onclick="confirmDelete(<?php echo $row['id']; ?>)">
                             <i class="fas fa-trash"></i> Hapus
                        </a>

                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="grid-column: 1 / -1; text-align: center;">Belum ada gambar ayat</p>
    <?php endif; ?>
</div>
<a href="tambah_gambar_ayat.php" class="btn btn-primary" style="margin-bottom: 20px;">+ Tambah Gambar Ayat</a>

            </div>
        </div>
    </div>
    <script>
            function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus gambar ini?")) {
            window.location.href = "gambar_ayat.php?action=delete&id=" + id;
        }
    }
    </script>

</body>
</html>
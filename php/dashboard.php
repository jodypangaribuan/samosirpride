<?php
session_start();

// Pengecekan login yang lebih ketat
if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Tambahkan waktu timeout session (30 menit)
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    // Jika lebih dari 30 menit tidak aktif, logout
    session_unset();
    session_destroy();
    header("Location: login.php?timeout=true");
    exit;
}
$_SESSION['last_activity'] = time();

// Koneksi database untuk mengambil data user
include "koneksi.php";
$user_id = $_SESSION['user_id'];
$query = "SELECT username FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Menghitung total jemaat
$total_jemaat_query = "SELECT COUNT(*) AS total FROM jemaat";
$total_jemaat_result = mysqli_query($conn, $total_jemaat_query);
$total_jemaat_data = mysqli_fetch_assoc($total_jemaat_result);
$total_jemaat = $total_jemaat_data['total'];

// Menghitung total ayat harian
$total_ayat_query = "SELECT COUNT(*) AS total FROM ayat_harian";
$total_ayat_result = mysqli_query($conn, $total_ayat_query);
$total_ayat_data = mysqli_fetch_assoc($total_ayat_result);
$total_ayat = $total_ayat_data['total'];

// Menghitung total program pelayanan
$total_pelayanan_query = "SELECT COUNT(*) AS total FROM program_pelayanan";
$total_pelayanan_result = mysqli_query($conn, $total_pelayanan_query);
$total_pelayanan_data = mysqli_fetch_assoc($total_pelayanan_result);
$total_pelayanan = $total_pelayanan_data['total'];

// Ambil pengumuman terbaru dari program_pelayanan
$pengumuman_query = "SELECT * FROM program_pelayanan ORDER BY no DESC LIMIT 1";
$pengumuman_result = mysqli_query($conn, $pengumuman_query);
$pengumuman = mysqli_fetch_assoc($pengumuman_result);

// Ambil ayat harian terbaru
$ayat_query = "SELECT * FROM ayat_harian ORDER BY tanggal_dibuat DESC LIMIT 1";
$ayat_result = mysqli_query($conn, $ayat_query);
$ayat = mysqli_fetch_assoc($ayat_result);

// Ambil jadwal ibadah mendatang (yang tanggalnya >= hari ini)
$jadwal_query = "SELECT * FROM jadwal_ibadah ORDER BY id DESC LIMIT 1";
$jadwal_result = mysqli_query($conn, $jadwal_query);
$jadwal_ibadah = [];
while ($row = mysqli_fetch_assoc($jadwal_result)) {
    $jadwal_ibadah[] = $row;
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Gereja - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Merriweather:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3b5998;
            --primary-dark: #2d4373;
            --secondary-color: #f5f7fa;
            --text-color: #333;
            --text-light: #ffffff;
            --border-color: #e3e6f0;
            --accent-color: #4e73df;
            --danger-color: #e74a3b;
            --success-color: #1cc88a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--secondary-color);
            color: var(--text-color);
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--text-light);
            padding-top: 20px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-header h2 {
            font-size: 22px;
            margin-left: 10px;
            font-weight: 600;
        }

        .nav-item {
            width: 100%;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.3s;
            margin: 2px 0;
            border-radius: 5px;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }

        .nav-icon {
            width: 20px;
            text-align: center;
            margin-right: 15px;
            font-size: 18px;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 25px;
            background-color: #fff;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border-radius: 5px;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 24px;
            color: var(--primary-dark);
        }

        .user-welcome {
            font-size: 16px;
            color: var(--text-color);
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 25px;
            margin-bottom: 25px;
        }

        .card {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            padding: 25px;
        }

        .card-header {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 10px;
        }

        .card-content {
            min-height: 150px;
        }

        .stat-card {
            display: flex;
            align-items: center;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            background-color: #fff;
            margin-bottom: 20px;
        }

        .stat-icon {
            font-size: 30px;
            margin-right: 20px;
            padding: 15px;
            border-radius: 50%;
            color: white;
        }

        .stat-icon.blue {
            background-color: var(--accent-color);
        }

        .stat-icon.red {
            background-color: var(--danger-color);
        }

        .stat-icon.green {
            background-color: var(--success-color);
        }

        .stat-info h3 {
            font-size: 22px;
            margin-bottom: 5px;
        }

        .stat-info p {
            color: #6c757d;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .sidebar-header h2,
            .nav-item span {
                display: none;
            }

            .nav-icon {
                margin-right: 0;
            }

            .main-content {
                margin-left: 70px;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php include "../templates/sidebar.php"; ?>
    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Dashboard</h1>
            <div class="user-welcome">Selamat datang, Admin</div>
        </div>

        <div class="row">
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $total_jemaat; ?></h3>
                    <p>Total Jemaat</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $total_pelayanan ?></h3>
                    <p>Kegiatan Minggu ini</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon red">
                    <i class="fas fa-bible"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $total_ayat; ?></h3>
                    <p>Ayat Harian</p>
                </div>
            </div>
        </div>

        <div class="dashboard-cards">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-bullhorn"></i>
                    Pengumuman Terbaru
                </div>
                <div class="card-content">
                    <?php if ($pengumuman): ?>
                        <p><strong><?= htmlspecialchars($pengumuman['uraian']); ?></strong></p>
                        <p>Bentuk: <?= htmlspecialchars($pengumuman['bentuk']); ?></p>
                        <p>Waktu: <?= htmlspecialchars($pengumuman['waktu_pelaksanaan']); ?></p>
                    <?php else: ?>
                        <p>Tidak ada pengumuman terbaru.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="fas fa-bible"></i>
                    Ayat Harian
                </div>
                <div class="card-content">
                    <?php if ($ayat): ?>
                        <p><strong><?= htmlspecialchars($ayat['referensi']); ?></strong></p>
                        <p><?= htmlspecialchars($ayat['ayat']); ?></p>
                        <p style="font-size:12px;color:#888;">
                            <?= date('l, d F Y', strtotime($ayat['tanggal_dibuat'])); ?>
                        </p>
                    <?php else: ?>
                        <p>Tidak ada ayat harian terbaru.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="fas fa-calendar-alt"></i>
                    Jadwal Ibadah Mendatang
                </div>
                <div class="card-content">
                    <?php if (!empty($jadwal_ibadah)): ?>
                        <?php foreach ($jadwal_ibadah as $jadwal): ?>
                            <p>
                                <strong><?= htmlspecialchars($jadwal['hari']); ?></strong> - 
                                <?= htmlspecialchars($jadwal['ibadah']); ?> 
                                (<?= htmlspecialchars($jadwal['keterangan']); ?>)
                            </p>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Tidak ada jadwal ibadah mendatang.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
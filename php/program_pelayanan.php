<?php
session_start();
include "koneksi.php";

// Cek session login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Proses hapus data
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['no'])) {
    $no = $_GET['no'];
    
    // Validasi input
    if (!is_numeric($no)) {
        die("Invalid input");
    }

    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("DELETE FROM program_pelayanan WHERE no = ?");
    $stmt->bind_param("i", $no);

    if ($stmt->execute()) {
        header("Location: program_pelayanan.php?status=deleted");
        exit;
    } else {
        die("Error menghapus data: " . $stmt->error);
    }
}

// Ambil data program pelayanan dengan pagination
$limit = 10; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query dengan pagination
$query = "SELECT * FROM program_pelayanan ORDER BY no DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);

// Hitung total data untuk pagination
$total_query = "SELECT COUNT(*) as total FROM program_pelayanan";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_data = $total_row['total'];
$total_pages = ceil($total_data / $limit);

// Dapatkan nama file saat ini
$current_page = basename($_SERVER['PHP_SELF']);
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Gereja - Program</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Merriweather:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        .pagination {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }
        .pagination a {
            margin: 0 5px;
            padding: 8px 12px;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
        .pagination a.active {
            background-color: #0056b3;
            font-weight: bold;
        }
        .pagination a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include "../templates/sidebar.php"; ?>
        <div class="content">
            <div class="content-header">
                <h1>Kelola Program Pelayanan</h1>
                <div class="user-info">
                    <span>Selamat datang, Admin</span>
                </div>
            </div>


            <!-- Daftar Ayat Harian -->
            <div class="main-content" style="margin-top: 1.5rem;">
                <h2 class="section-title">Daftar Program Pelayanan</h2>
                <a href="tambah_program_pelayanan.php" class="btn btn-primary" style="padding: 8px 12px; background-color: #007bff; color: white; border-radius: 5px; text-decoration: none;">
                    <i class="fas fa-plus"></i> Tambahkan Program Pelayanan
                 </a>
                <?php if (isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
    <div style="color: green; margin-bottom: 10px;">
        Data berhasil dihapus.
    </div>
<?php endif; ?>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Uraian</th>
                                <th>Bentuk</th>
                                <th>Waktu Pelaksanaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php $no = $offset + 1; ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo htmlspecialchars($row['uraian']); ?></td>
                                        <td><?php echo htmlspecialchars($row['bentuk']); ?></td>
                                        <td><?php echo htmlspecialchars($row['waktu_pelaksanaan']); ?></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="btn btn-sm btn-view"
                                                    onclick="window.location.href='edit_program_pelayanan.php?no=<?php echo $row['no']; ?>'">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-delete"
                                                    onclick="confirmDelete(<?php echo $row['no']; ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align: center;">Belum ada Program Pelayanan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php include "../templates/pagination.php"; ?>
            </div>
        </div>
    </div>
</body>
<script>
    function confirmDelete(no) {
        if (confirm('Apakah anda yakin ingin menghapus program pelayanan ini?')) {
            window.location.href = 'program_pelayanan.php?action=delete&no=' + no;
        }
    }
</script>
</html>
<?php
session_start();
include "koneksi.php";

$status = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi dan sanitasi input
    $nama_kategori = isset($_POST['nama_kategori']) ? mysqli_real_escape_string($conn, trim($_POST['nama_kategori'])) : '';
    $keterangan = isset($_POST['keterangan']) ? mysqli_real_escape_string($conn, trim($_POST['keterangan'])) : '';

    if (empty($nama_kategori) || empty($keterangan)) {
        $status = "error";
        $message = "Semua field harus diisi.";
    } else {
        // Masukkan ke database
        $query = "INSERT INTO kategori_struktur_gereja (nama_kategori, keterangan) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $nama_kategori, $keterangan);

        if ($stmt->execute()) {
            header("Location: kategori_struktur_gereja.php?status=success&message=" . urlencode("Data kategori berhasil ditambahkan."));
            exit;
        } else {
            $status = "error";
            $message = "Gagal menyimpan data: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori Struktur Gereja</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --text-color: #5a5c69;
            --success-color: #1cc88a;
            --border-color: #e3e6f0;
            --error-color: #e74a3b;
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
            line-height: 1.6;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            padding: 25px;
        }
        
        .header {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        h2 {
            color: #333;
            font-weight: 600;
        }
        
        .back-link {
            text-decoration: none;
            color: var(--primary-color);
            display: inline-flex;
            align-items: center;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .back-link:hover {
            opacity: 0.8;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }
        
        textarea, input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 16px;
            transition: border 0.3s;
        }
        
        textarea {
            min-height: 150px;
            resize: vertical;
        }
        
        textarea:focus, input[type="text"]:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        
        button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        button:hover {
            background-color: #2e59d9;
        }
        
        .cancel-btn {
            background-color: #e74a3b;
        }
        
        .cancel-btn:hover {
            background-color: #c23321;
        }
        
        .alert {
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .alert-icon {
            font-size: 18px;
        }
        
        .help-text {
            font-size: 14px;
            color: #6c757d;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Tambah Dokumentasi Kategori Struktur Gereja</h2>
        <a href="kategori_struktur_gereja.php" class="back-link"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <?php if ($status == "error"): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle alert-icon"></i> <?php echo $message; ?>
        </div>
    <?php endif; ?>

    

    <form method="POST">
    <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" value="<?php echo isset($_POST['nama_kategori']) ? htmlspecialchars($_POST['nama_kategori']) : ''; ?>" required>
        </div> 

        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" value="<?php echo isset($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']) : ''; ?>" required>
        </div> 

        <div class="button-group">
            <button type="submit"><i class="fas fa-save"></i> Simpan</button>
            <a href="kategori_struktur_gereja.php" class="btn cancel-btn"><i class="fas fa-times"></i> Batal</a>
        </div>
    </form>
</div>
</body>
</html>
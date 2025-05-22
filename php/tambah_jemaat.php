<?php
session_start(); // pastikan session aktif
include "koneksi.php";

$status = "";
$message = "";

// Pastikan user login
if (!isset($_SESSION['user_id'])) {
    die("Anda harus login dulu.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $tempat_lahir = mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $nomor_telepon = mysqli_real_escape_string($conn, $_POST['nomor_telepon']);
    $user_id = $_SESSION['user_id']; // Ambil dari session

    if (empty($nama) || empty($jenis_kelamin) || empty($tempat_lahir) || empty($tanggal_lahir) || empty($alamat) || empty($nomor_telepon)) {
        $status = "error";
        $message = "Semua field harus diisi.";
    } else {
        $query = "INSERT INTO jemaat (nama, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, nomor_telepon, user_id)
                  VALUES ('$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$nomor_telepon', '$user_id')";

        if (mysqli_query($conn, $query)) {
            header("Location: jemaat.php?status=success&message=" . urlencode("Jemaat berhasil ditambahkan"));
            exit;
        } else {
            $status = "error";
            $message = "Error: " . mysqli_error($conn);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah  Jemaat</title>
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
            <h2>Tambah Jemaat</h2>
            <a href="jemaat.php" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <?php if ($status == "error"): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle alert-icon"></i>
            <?php echo $message; ?>
        </div>
        <?php endif; ?>
                                
        <form method="POST">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <textarea name="nama" id="nama" required><?php echo isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?></textarea>
                <div class="help-text">Masukkan nama dengan lengkap</div>
            </div>
            
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <input type="text" name="jenis_kelamin" id="jenis_kelamin" value="<?php echo isset($_POST['jenis_kelamin']) ? htmlspecialchars($_POST['jenis_kelamin']) : ''; ?>" required>
                <div class="help-text">Laki-Laki/Perempuan</div>
            </div>

            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir:</label>
                <textarea name="tempat_lahir" id="tempat_lahir" required><?php echo isset($_POST['tempat_lahir']) ? htmlspecialchars($_POST['tempat_lahir']) : ''; ?></textarea>
                <div class="help-text">Contoh : Jakarta </div>
            </div>
            
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal/Bulan/Tahun Lahir:</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo isset($_POST['tanggal_lahir']) ? htmlspecialchars($_POST['tanggal_lahir']) : ''; ?>" required>
                <div class="help-text">Contoh : 09/07/2005</div>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" required><?php echo isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : ''; ?></textarea>
                <div class="help-text">Contoh: Jln. Gatot Subroto,Jakarta</div>
            </div>
            
            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon:</label>
                <input type="text" name="nomor_telepon" id="nomor_telepon" value="<?php echo isset($_POST['nomor_telepon']) ? htmlspecialchars($_POST['nomor_telepon']) : ''; ?>" required>
                <div class="help-text">Contoh format: +628xxxxxxxxxx</div>
            </div>
            
            <div class="button-group">
                <a href="jemaat.php" class="back-link">
                    <button type="button" class="cancel-btn">
                        <i class="fas fa-times"></i> Batal
                    </button>
                </a>
                <button type="submit">
                    <i class="fas fa-save"></i> Simpan 
                </button>
            </div>
        </form>
    </div>
</body>
</html>
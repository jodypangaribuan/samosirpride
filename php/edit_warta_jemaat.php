<?php
session_start();
include "koneksi.php";

// Cek login
if (!isset($_SESSION['user_id'])) {
    die("Anda harus login terlebih dahulu.");
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: warta_jemaat.php");
    exit;
}

// Ambil data warta
$result = mysqli_query($conn, "SELECT * FROM warta_jemaat WHERE id = $id");
if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: warta_jemaat.php");
    exit;
}
$warta = mysqli_fetch_assoc($result);
$error = "";

// Proses jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $user_id = $_SESSION['user_id'];
    $file_pdf = $warta['file_pdf']; // Default: file lama

    // Jika ada file baru
    if (isset($_FILES['file_pdf']) && $_FILES['file_pdf']['error'] === UPLOAD_ERR_OK) {
        $allowedExt = ['pdf'];
        $fileTmp = $_FILES['file_pdf']['tmp_name'];
        $fileName = basename($_FILES['file_pdf']['name']);
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileExt, $allowedExt)) {
            $uploadDir = 'uploads/warta_jemaat/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $newFileName = uniqid('warta_', true) . '.' . $fileExt;
            $uploadPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmp, $uploadPath)) {
                // Hapus file lama jika ada
                if (!empty($warta['file_pdf']) && file_exists($uploadDir . $warta['file_pdf'])) {
                    unlink($uploadDir . $warta['file_pdf']);
                }
                $file_pdf = $newFileName;
            } else {
                $error = "Gagal mengunggah file baru.";
            }
        } else {
            $error = "Hanya file PDF yang diperbolehkan.";
        }
    }

    // Simpan ke database jika tidak ada error
    if (empty($error)) {
        $query = "UPDATE warta_jemaat 
                  SET judul = '$judul', keterangan = '$keterangan', file_pdf = '$file_pdf', user_id = '$user_id' 
                  WHERE id = $id";

        if (mysqli_query($conn, $query)) {
            header("Location: warta_jemaat.php?status=success&message=" . urlencode("Warta Jemaat berhasil diperbarui"));
            exit;
        } else {
            $error = "Error saat menyimpan: " . mysqli_error($conn);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Warta Jemaat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --text-color: #5a5c69;
            --success-color: #1cc88a;
            --border-color: #e3e6f0;
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
            margin-top: 10px;
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
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
   
<div class="container">
    <div class="header">
        <h2>Edit Warta Jemaat</h2>
        <a href="warta_jemaat.php" style="text-decoration:none;color:var(--primary-color)">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="judul">Judul</label>
            <textarea name="judul" id="judul" required><?php echo htmlspecialchars($warta['judul']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" value="<?php echo htmlspecialchars($warta['keterangan']); ?>" required>
        </div>
        <div class="form-group">
            <label for="file_pdf">File PDF Baru (Opsional)</label>
            <input type="file" name="file_pdf" accept="application/pdf">
            <?php if (!empty($warta['file_pdf'])): ?>
                <small>File saat ini: <a href="uploads/warta_jemaat/<?php echo $warta['file_pdf']; ?>" target="_blank"><?php echo $warta['file_pdf']; ?></a></small>
            <?php endif; ?>
        </div>
        <div class="button-group">
            <a href="warta_jemaat.php">
                <button type="button" class="cancel-btn"><i class="fas fa-times"></i> Batal</button>
            </a>
            <button type="submit"><i class="fas fa-save"></i> Simpan Perubahan</button>
        </div>
    </form>
</div>
</body>
</html>
<?php
include "koneksi.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: gambar_ayat.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM gambar_ayat WHERE id = $id");

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: gambar_ayat.php");
    exit;
}

$gambar_ayat = mysqli_fetch_assoc($result);
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $referensi = mysqli_real_escape_string($conn, $_POST['referensi']);
    
    // Jika ada file baru diupload
    if (!empty($_FILES["gambar"]["name"])) {
        $target_dir = "uploads/ayat/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check === false) {
            $error = "File bukan gambar.";
            $uploadOk = 0;
        }

        // Check file size (max 5MB)
        if ($_FILES["gambar"]["size"] > 5000000) {
            $error = "Ukuran gambar terlalu besar (maks 5MB).";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowed_types)) {
            $error = "Hanya format JPG, JPEG, PNG & GIF yang diperbolehkan.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            // Hapus file lama
            if (file_exists($gambar_ayat['gambar'])) {
                unlink($gambar_ayat['gambar']);
            }
            
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                $update_query = "UPDATE gambar_ayat SET referensi='$referensi', gambar='$target_file', tanggal_dibuat='$tanggal_dibuat'  WHERE id=$id";
            } else {
                $error = "Maaf, terjadi error saat mengupload gambar.";
            }
        }
    } else {
        // Jika tidak ada file baru diupload, hanya update referensi
        $update_query = "UPDATE gambar_ayat SET referensi='$referensi', tanggal_dibuat='$tanggal_dibuat'  WHERE id=$id";
    }
    
    if (empty($error) && isset($update_query)) {
        if (mysqli_query($conn, $update_query)) {
            header("Location: gambar_ayat.php?status=success&message=Gambar ayat berhasil diperbarui");
            exit;
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ayat Harian</title>
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
        .current-image {
            max-width: 100%;
            max-height: 300px;
            margin: 20px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }
    </style>
</head>
<body>
<div class="container">
        <div class="header">
            <h2>Edit Gambar Ayat</h2>
            <a href="gambar_ayat.php" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle alert-icon"></i>
            <?php echo $error; ?>
        </div>
        <?php endif; ?>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="referensi">Referensi:</label>
                <input type="text" name="referensi" id="referensi" 
                       value="<?php echo htmlspecialchars($gambar_ayat['referensi']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Gambar Saat Ini:</label>
                <img src="<?php echo htmlspecialchars($gambar_ayat['gambar']); ?>" class="current-image">
            </div>
            
            <div class="form-group">
                <label for="gambar">Gambar Baru (kosongkan jika tidak ingin mengubah):</label>
                <input type="file" name="gambar" id="gambar" accept="image/*">
                <div class="help-text">Format: JPG, JPEG, PNG, GIF (maks 5MB)</div>
            </div>

            <div class="form-group">
                <label for="tanggal_dibuat">Tanggal Dibuat:</label>
                 <input type="date" name="tanggal_dibuat" id="tanggal_dibuat" 
                value="<?php echo isset($gambar_ayat['tanggal_dibuat']) ? date('Y-m-d', strtotime($gambar_ayat['tanggal_dibuat'])) : ''; ?>" required>
            </div>

            
            <div class="button-group">
                <a href="gambar_ayat.php" class="back-link">
                    <button type="button" class="cancel-btn">
                        <i class="fas fa-times"></i> Batal
                    </button>
                </a>
                <button type="submit">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</body>
</html>
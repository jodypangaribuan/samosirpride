<?php
include "koneksi.php";

$status = "";
$message = "";
session_start();
$user_id = $_SESSION['user_id'] ?? 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $referensi = mysqli_real_escape_string($conn, $_POST['referensi']);
    
    // Handle file upload
    $target_dir = "uploads/ayat/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check === false) {
        $status = "error";
        $message = "File bukan gambar.";
        $uploadOk = 0;
    }

    // Check file size (max 5MB)
    if ($_FILES["gambar"]["size"] > 5000000) {
        $status = "error";
        $message = "Ukuran gambar terlalu besar (maks 5MB).";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowed_types)) {
        $status = "error";
        $message = "Hanya format JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $query = "INSERT INTO gambar_ayat (user_id, referensi, gambar, tanggal_dibuat) VALUES ('$user_id', '$referensi', '$target_file', '$tanggal_dibuat')";
            
            if (mysqli_query($conn, $query)) {
                header("Location: gambar_ayat.php?status=success&message=Gambar ayat berhasil ditambahkan");
                exit;
            } else {
                unlink($target_file); // Hapus file yang sudah diupload jika query gagal
                $status = "error";
                $message = "Error: " . mysqli_error($conn);
            }
        } else {
            $status = "error";
            $message = "Maaf, terjadi error saat mengupload gambar.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ayat Harian</title>
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
        /* [Styles tetap sama] */
        .preview-container {
            margin: 20px 0;
            text-align: center;
        }
        .preview-image {
            max-width: 100%;
            max-height: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }
    
    </style>
</head>
<body>
<div class="container">
        <div class="header">
            <h2>Tambah Gambar Ayat</h2>
            <a href="gambar_ayat.php" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <?php if ($status == "error"): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle alert-icon"></i>
            <?php echo $message; ?>
        </div>
        <?php endif; ?>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="referensi">Referensi:</label>
                <input type="text" name="referensi" id="referensi" value="<?php echo isset($_POST['referensi']) ? htmlspecialchars($_POST['referensi']) : ''; ?>" required>
                <div class="help-text">Contoh format: Ulangan 8:18</div>
            </div>
            
            <div class="form-group">
                <label for="gambar">Gambar Ayat:</label>
                <input type="file" name="gambar" id="gambar" accept="image/*" required>
                <div class="help-text">Format: JPG, JPEG, PNG, GIF (maks 5MB)</div>
            </div>
            
            <div class="form-group">
                <label for="tanggal_dibuat">Tanggal Dibuat:</label>
                 <input type="date" name="tanggal_dibuat" id="tanggal_dibuat" value="<?php echo isset($_POST['tanggal_dibuat']) ? htmlspecialchars($_POST['tanggal_dibuat']) : ''; ?>" required>
            </div>

            <div class="preview-container">
                <img id="preview" class="preview-image" style="display: none;">
            </div>
            
            <div class="button-group">
                <a href="gambar_ayat.php" class="back-link">
                    <button type="button" class="cancel-btn">
                        <i class="fas fa-times"></i> Batal
                    </button>
                </a>
                <button type="submit">
                    <i class="fas fa-save"></i> Simpan Gambar
                </button>
            </div>
        </form>
    </div>
    
    <script>
        // Preview gambar sebelum upload
        document.getElementById('gambar').addEventListener('change', function(e) {
            const preview = document.getElementById('preview');
            const file = e.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            
            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
<?php
include "koneksi.php";
session_start();

$status = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    $uploadOk = 1;
    $target_dir = "uploads/";
    $imageFileType = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));
    $new_filename = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $new_filename;

    // Cek apakah benar file gambar
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check === false) {
        $status = "error";
        $message = "File bukan gambar.";
        $uploadOk = 0;
    }

    // Cek ukuran gambar
    if ($_FILES["gambar"]["size"] > 2000000) {
        $status = "error";
        $message = "Ukuran gambar terlalu besar (max 2MB).";
        $uploadOk = 0;
    }

    // Cek format gambar
    $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedExtensions)) {
        $status = "error";
        $message = "Hanya format JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // DEBUG: tampilkan info file sebelum move_uploaded_file
    // var_dump("TEMP FILE: " . $_FILES["gambar"]["tmp_name"]);
    // var_dump("TARGET FILE: " . $target_file);
    // die("DEBUG: Cek apakah path dan permission sudah benar."); // ← Kamu bisa hapus ini setelah upload berhasil

    if ($uploadOk == 0) {
        $status = "error";
    } else {
        // Memindahkan file ke folder target
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            var_dump($target_file); // Memeriksa path tujuan upload
            $user_id = $_SESSION['user_id']; // Pastikan session sudah ada
            echo $user_id;
            $query = "INSERT INTO event_galeri (nama, deskripsi, gambar, user_id) 
                      VALUES ('$nama', '$deskripsi', '$new_filename', '$user_id')";

            if (mysqli_query($conn, $query)) {
                header("Location: event_galeri.php?status=success&message=" . urlencode("Event Galeri berhasil ditambahkan"));
                exit;
            } else {
                $status = "error";
                $message = "Error: " . mysqli_error($conn);
                unlink($target_file); // Hapus file yang sudah di-upload jika gagal
            }
        } else {
            $status = "error";
            $message = "Terjadi kesalahan saat mengupload gambar.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Galeri - Admin Gereja</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --text-color: #5a5c69;
            --success-color: #1cc88a;
            --error-color: #e74a3b;
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
            padding: 30px;
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
            color: var(--primary-color);
            font-weight: 600;
            margin: 0;
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
        
        .form-container {
            margin-top: 20px;
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
        
        .required:after {
            content: " *";
            color: var(--error-color);
        }
        
        input[type="text"],
        textarea,
        input[type="file"] {
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
        
        input:focus, textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .button-group {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
            gap: 15px;
        }
        
        .btn {
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            border: none;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #2e59d9;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
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
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-icon {
            font-size: 18px;
        }
        
        .help-text {
            font-size: 14px;
            color: #6c757d;
            margin-top: 5px;
            font-style: italic;
        }
        
        .preview-container {
            margin-top: 15px;
            display: none;
        }
        
        .image-preview {
            max-width: 100%;
            max-height: 200px;
            border-radius: 4px;
            border: 1px solid var(--border-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2><i class="fas fa-camera"></i> Tambah Galeri</h2>
            <a href="event_galeri.php" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <?php if ($status == "error"): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle alert-icon"></i>
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php endif; ?>
        
        <div class="form-container">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama" class="required">Nama Event</label>
                    <input type="text" id="nama" name="nama" required>
                </div>
                
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" id="keterangan" name="keterangan">
                    <p class="help-text">Penjelasan singkat tentang event</p>
                </div>
                
                <div class="form-group">
                    <label for="deskripsi" class="required">Deskripsi Event</label>
                    <textarea id="deskripsi" name="deskripsi" required></textarea>
                </div>
                
                <div class="form-group">
                    <label class="required">Gambar</label>
                    <input type="file" name="gambar" accept="image/*" required onchange="previewImage(this)">
                    <div class="preview-container">
                        <p>Pratinjau:</p>
                        <img id="imagePreview" class="image-preview" src="#" alt="Pratinjau Gambar">
                    </div>
                    <p class="help-text">Format: JPG, JPEG, PNG, GIF. Ukuran maksimal 2MB.</p>
                </div>
                
                <div class="button-group">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='event_galeri.php'">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const previewContainer = document.querySelector('.preview-container');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                previewContainer.style.display = 'none';
            }
        }
    </script>
</body>
</html>

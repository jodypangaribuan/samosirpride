<?php
include "koneksi.php";
session_start();

$status = "";
$message = "";

// Ambil daftar kategori dari database
$kategoriQuery = "SELECT id, nama_kategori FROM kategori_struktur_gereja";
$kategoriResult = mysqli_query($conn, $kategoriQuery);

$validKategori = [];
while ($row = mysqli_fetch_assoc($kategoriResult)) {
    $validKategori[$row['id']] = $row['nama_kategori'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori_id = mysqli_real_escape_string($conn, $_POST['kategori']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    $uploadOk = 1;
    $target_dir = "uploads/struktur_gereja/";
    $imageFileType = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));
    $new_filename = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $new_filename;

    // Validasi gambar
    if (isset($_FILES["gambar"]["tmp_name"]) && $_FILES["gambar"]["tmp_name"] != "") {
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check === false) {
            $status = "error";
            $message = "File bukan gambar.";
            $uploadOk = 0;
        }

        if ($_FILES["gambar"]["size"] > 2000000) {
            $status = "error";
            $message = "Ukuran gambar terlalu besar (max 2MB).";
            $uploadOk = 0;
        }

        $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedExtensions)) {
            $status = "error";
            $message = "Format gambar tidak didukung.";
            $uploadOk = 0;
        }
    } else {
        $status = "error";
        $message = "Gambar tidak ditemukan.";
        $uploadOk = 0;
    }

    if ($uploadOk && isset($_SESSION['user_id']) && array_key_exists($kategori_id, $validKategori)) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $user_id = $_SESSION['user_id'];
            $query = "INSERT INTO struktur_gereja (nama, kategori_id, deskripsi, gambar, user_id) 
                      VALUES ('$nama', '$kategori_id', '$deskripsi', '$new_filename', '$user_id')";
    
            if (mysqli_query($conn, $query)) {
                header("Location: struktur_gereja.php?status=success&message=" . urlencode("Struktur Gereja berhasil ditambahkan"));
                exit;
            } else {
                $status = "error";
                $message = "Database error: " . mysqli_error($conn);
                if (file_exists($target_file)) {
                    unlink($target_file);
                }
            }
        } else {
            $status = "error";
            $message = "Upload gambar gagal.";
        }
    } elseif (!array_key_exists($kategori_id, $validKategori)) {
        $status = "error";
        $message = "Kategori tidak valid.";
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

        /* Align menu and search bar with logo */
        .header-navigation-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
        }

        .site-logo {
            flex-shrink: 0;
        }

        .header-navigation {
            flex-grow: 1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .header-navigation ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 20px;
        }

        .header-navigation li {
            position: relative;
        }

        .header-navigation li a {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .header-navigation li a:hover {
            color: #0066cc;
        }

        /* Search box styling */
        .menu-search {
            position: relative;
            margin-left: 20px;
            display: flex;
            align-items: center;
        }

        .search-box {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .search-box.active {
            display: block;
        }

        .search-btn {
            cursor: pointer;
            font-size: 18px;
            color: #333;
            transition: color 0.3s;
            padding: 10px 15px;
        }

        .search-btn:hover {
            color: #0066cc;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2><i class="fas fa-user-friends"></i> Tambah Struktur Gereja</h2>
        <a href="struktur_gereja.php" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <?php if ($status == "error"): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle alert-icon"></i>
            <?= htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <div class="form-container">
        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="nama" class="required">Nama Struktur Gereja</label>
                <input type="text" id="nama" name="nama" required>
            </div>

            <div class="form-group">
                <label for="kategori" class="required">Pilih Kategori</label>
                <select name="kategori" id="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($validKategori as $id => $namaKategori): ?>
                        <option value="<?= htmlspecialchars($id); ?>"><?= htmlspecialchars($namaKategori); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="deskripsi" class="required">Deskripsi Struktur Gereja</label>
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
                <button type="button" class="btn btn-secondary" onclick="window.location.href='struktur_gereja.php'">
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
            reader.onload = function (e) {
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
<?php
include "koneksi.php";

// Validasi dan sanitasi input ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: struktur_gereja.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM struktur_gereja WHERE id = $id");

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: struktur_gereja.php");
    exit;
}

$struktur = mysqli_fetch_assoc($result);

// Ambil daftar kategori dari database
$kategoriQuery = "SELECT id, nama_kategori FROM kategori_struktur_gereja";
$kategoriResult = mysqli_query($conn, $kategoriQuery);

$validKategori = [];
while ($row = mysqli_fetch_assoc($kategoriResult)) {
    $validKategori[$row['id']] = $row['nama_kategori'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitasi input form
    $new_nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $new_kategori_id = mysqli_real_escape_string($conn, $_POST['kategori']);
    $new_deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    
    // Menjaga gambar lama jika tidak ada gambar baru
    $new_gambar = $struktur['gambar'];
    
    // Cek apakah gambar baru diupload
    if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "uploads/struktur_gereja/";
        $imageFileType = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $new_filename;
        
        // Validasi apakah file yang diupload adalah gambar
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check !== false) {
            // Validasi ukuran gambar (maksimal 2MB)
            if ($_FILES["gambar"]["size"] <= 2000000) {
                // Izinkan format gambar JPG, JPEG, PNG, GIF
                $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
                if (in_array($imageFileType, $allowedExtensions)) {
                    // Coba upload file gambar
                    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                        // Hapus gambar lama jika ada
                        if (!empty($struktur['gambar']) && file_exists($target_dir . $struktur['gambar'])) {
                            unlink($target_dir . $struktur['gambar']);
                        }
                        $new_gambar = $new_filename;
                    } else {
                        $error = "Terjadi kesalahan saat mengupload gambar.";
                    }
                } else {
                    $error = "Hanya format JPG, JPEG, PNG & GIF yang diperbolehkan.";
                }
            } else {
                $error = "Ukuran gambar terlalu besar (maks 2MB).";
            }
        } else {
            $error = "File yang diupload bukan gambar.";
        }
    }
    
    // Jika tidak ada error, lakukan update data
    if (!isset($error) && array_key_exists($new_kategori_id, $validKategori)) {
        $update_query = "UPDATE struktur_gereja SET nama='$new_nama', kategori_id='$new_kategori_id', deskripsi='$new_deskripsi', gambar='$new_gambar' WHERE id=$id";
        
        if (mysqli_query($conn, $update_query)) {
            header("Location: struktur_gereja.php?status=success&message=" . urlencode("Struktur Gereja berhasil diperbarui"));
            exit;
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    } elseif (!array_key_exists($new_kategori_id, $validKategori)) {
        $error = "Kategori tidak valid.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Struktur Gereja</title>
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
        
        textarea, input[type="text"], select {
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
        
        textarea:focus, input[type="text"]:focus, select:focus {
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
        <div class="form-container">
            <div class="header">
                <h2>Edit Struktur Gereja</h2>
                <a href="struktur_gereja.php" class="back-link">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            
            <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
            <?php endif; ?>
            
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" value="<?php echo htmlspecialchars($struktur['nama']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($validKategori as $id => $namaKategori): ?>
                            <option value="<?= htmlspecialchars($id); ?>" <?= $struktur['kategori_id'] == $id ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($namaKategori); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" rows="4" required><?php echo htmlspecialchars($struktur['deskripsi']); ?></textarea>
                </div>

                <div class="form-group">
                    <label>Ganti Gambar (kosongkan jika tidak ingin mengubah)</label>
                    <input type="file" name="gambar" accept="image/*">
                    
                    <?php if (!empty($struktur['gambar'])): ?>
                    <div class="current-image">
                        <p>Gambar saat ini:</p>
                        <img src="uploads/struktur_gereja/<?php echo htmlspecialchars($struktur['gambar']); ?>" alt="Current Image" style="width: 100%; max-width: 200px;">
                    </div>
                    <?php endif; ?>
                </div>

                <div class="button-group">
                    <button type="button" class="cancel-btn" onclick="window.location.href='struktur_gereja.php'">Batal</button>
                    <button type="submit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

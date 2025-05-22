<?php
include "koneksi.php";

// Validate and sanitize input
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: acara_koor.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM acara_koor WHERE id = $id");

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: acara_koor.php");
    exit;
}

$event = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_nama = mysqli_real_escape_string($conn, $_POST['nama']);
    
    // Keep the old image by default
    $new_gambar = $event['gambar'];
    
    // Check if a new image was uploaded
    if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "uploads/acara_koor";
        $imageFileType = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $new_filename;
        
        // Check if image file is a actual image
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check !== false) {
            // Check file size (max 2MB)
            if ($_FILES["gambar"]["size"] <= 2000000) {
                // Allow certain file formats
                $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
                if (in_array($imageFileType, $allowedExtensions)) {
                    // Try to upload file
                    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                        // Delete old image if it exists
                        if (!empty($event['gambar']) && file_exists($target_dir . $event['gambar'])) {
                            unlink($target_dir . $event['gambar']);
                        }
                        $new_gambar = $new_filename;
                    } else {
                        $error = "Terjadi kesalahan saat mengupload gambar.";
                    }
                } else {
                    $error = "Hanya format JPG, JPEG, PNG & GIF yang diperbolehkan.";
                }
            } else {
                $error = "Ukuran gambar terlalu besar (max 2MB).";
            }
        } else {
            $error = "File bukan gambar.";
        }
    }
    
    if (!isset($error)) {
        $update_query = "UPDATE acara_koor SET nama='$new_nama',  gambar='$new_gambar' WHERE id=$id";
        
        if (mysqli_query($conn, $update_query)) {
            header("Location: acara_koor.php?status=success&message=".urlencode("Acara Koor berhasil diperbarui"));
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
    <title>Edit Acara Koor</title>
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
        <div class="form-container">
            <div class="header">
                <h2>Edit Acara Koor</h2>
                <a href="acara_koor.php" class="back-link">
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
                    <label>Nama Event</label>
                    <input type="text" name="nama" value="<?php echo htmlspecialchars($event['nama']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Ganti Gambar (kosongkan jika tidak ingin mengubah)</label>
                    <input type="file" name="gambar" accept="image/*">
                    
                    <?php if (!empty($event['gambar'])): ?>
                    <div class="current-image">
                        <p>Gambar saat ini:</p>
                        <img src="uploads/acara_koor<?php echo htmlspecialchars($event['gambar']); ?>" alt="Current Image">
                    </div>
                    <?php endif; ?>
                </div>

                <div class="button-group">
                    <button type="button" class="cancel-btn" onclick="window.location.href='acara_koor.php'">Batal</button>
                    <button type="submit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
include "koneksi.php";

// Validate and sanitize input
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: jemaat.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM jemaat WHERE id = $id");

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: jemaat.php");
    exit;
}

$jemaat = mysqli_fetch_assoc($result);
                                
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $new_jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $new_tempat_lahir = mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
    $new_tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
    $new_alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $new_nomor_telepon = mysqli_real_escape_string($conn, $_POST['nomor_telepon']);

    $update_query = "UPDATE jemaat SET nama='$new_nama', jenis_kelamin='$new_jenis_kelamin', tempat_lahir='$new_tempat_lahir', tanggal_lahir='$new_tanggal_lahir', alamat='$new_alamat', nomor_telepon='$new_nomor_telepon' WHERE id=$id";
    
    if (mysqli_query($conn, $update_query)) {
        header("Location: jemaat.php?status=success&message=".urlencode("jemaat berhasil diperbarui"));
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Ibadah</title>
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
            <h2>Edit jemaat</h2>
            <a href="jemaat.php" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
        <?php endif; ?>      
        <form method="POST">
            <div class="form-group">
                <label for="nama">Nama</label>
                <textarea name="nama" id="nama" required><?php echo htmlspecialchars($jemaat['nama']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <input type="text" name="jenis_kelamin" id="jenis_kelamin" value="<?php echo htmlspecialchars($jemaat['jenis_kelamin']); ?>" required>
            </div>

            <div class="form-group">
                <label for="tempat_lahir">Tempat lahir:</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" value="<?php echo htmlspecialchars($jemaat['tempat_lahir']); ?>" required>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal lahir:</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo htmlspecialchars($jemaat['tanggal_lahir']); ?>" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" name="alamat" id="alamat" value="<?php echo htmlspecialchars($jemaat['alamat']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon:</label>
                <input type="text" name="nomor_telepon" id="nomor_telepon" value="<?php echo htmlspecialchars($jemaat['nomor_telepon']); ?>" required>
            </div>

            <div class="button-group">
                <a href="jemaat.php" class="back-link">
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
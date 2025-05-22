<?php
include "koneksi.php";
session_start();

// Validate and sanitize input
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: koor.php");
    exit;
}

// Get existing data
$stmt = $conn->prepare("SELECT * FROM koor WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: koor.php");
    exit;
}

$koor = $result->fetch_assoc();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_nama = mysqli_real_escape_string($conn, trim($_POST['nama']));
    $new_tempat = mysqli_real_escape_string($conn, trim($_POST['tempat']));
    $new_waktu_latihan = mysqli_real_escape_string($conn, trim($_POST['waktu_latihan']));
    
    // Validate input
    if (empty($new_nama) || empty($new_tempat) || empty($new_waktu_latihan)) {
        $error = "Semua kolom harus diisi.";
    }

    if (empty($error)) {
        // Update the koor data in the database
        $update_stmt = $conn->prepare("UPDATE koor SET nama = ?, tempat = ?, waktu_latihan = ? WHERE id = ?");
        $update_stmt->bind_param("sssi", $new_nama, $new_tempat, $new_waktu_latihan, $id);
        
        if ($update_stmt->execute()) {
            header("Location: koor.php?status=success&message=" . urlencode("Koor berhasil diperbarui"));
            exit;
        } else {
            $error = "Gagal memperbarui data: " . $update_stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Galeri</title>
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
            <h2>Edit Koor</h2>
            <a href="koor.php" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="nama">Nama Acara:</label>
                <textarea name="nama" id="nama" required><?php echo htmlspecialchars($koor['nama']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="tempat">Tempat:</label>
                <input type="text" name="tempat" id="tempat" value="<?php echo htmlspecialchars($koor['tempat']); ?>" required>
            </div>

            <div class="form-group">
            <label for="waktu_latihan">Waktu Pelaksanaan:</label>
            <input type="text" name="waktu_latihan" id="waktu_latihan" value="<?php echo isset($_POST['waktu_latihan']) ? htmlspecialchars($_POST['waktu_latihan']) : htmlspecialchars($koor['waktu_latihan']); ?>" required>
        </div>


            
            <div class="button-group">
                <a href="koor.php" class="back-link">
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
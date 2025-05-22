<?php
include "koneksi.php";

// Validate and sanitize input
$no = isset($_GET['no']) ? (int)$_GET['no'] : 0;

if ($no <= 0) {
    header("Location: program_pelayanan.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM program_pelayanan WHERE no = $no");

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: program_pelayanan.php");
    exit;
}

$program = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_uraian = mysqli_real_escape_string($conn, $_POST['uraian']);
    $new_bentuk = mysqli_real_escape_string($conn, $_POST['bentuk']);
    $new_waktu_pelaksanaan = mysqli_real_escape_string($conn, $_POST['waktu_pelaksanaan']);

    $update_query = "UPDATE program_pelayanan SET uraian='$new_uraian', bentuk='$new_bentuk', waktu_pelaksanaan='$new_waktu_pelaksanaan' WHERE no=$no";
    
    if (mysqli_query($conn, $update_query)) {
        header("Location: program_pelayanan.php?status=success&message=".urlencode("program berhasil diperbarui"));
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
    <title>Edit Program Pelayanan</title>
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
            <h2>Edit Program Pelayanan</h2>
            <a href="program_pelayanan.php" class="back-link">
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
                <label for="uraian">Uraian</label>
                <textarea name="uraian" id="uraian" required><?php echo htmlspecialchars($program['uraian']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="bentuk">bentuk:</label>
                <input type="text" name="bentuk" id="bentuk" value="<?php echo htmlspecialchars($program['bentuk']); ?>" required>
            </div>

            <div class="form-group">
                <label for="waktu_pelaksanaan">Waktu Pelaksanaan:</label>
                <input type="text" name="waktu_pelaksanaan" id="waktu_pelaksanaan" value="<?php echo htmlspecialchars($program['waktu_pelaksanaan']); ?>" required>
            </div>
            
            <div class="button-group">
                <a href="program_pelayanan" class="back-link">
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
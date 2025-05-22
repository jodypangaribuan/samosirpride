<?php
include "koneksi.php";
$status = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirm = mysqli_real_escape_string($conn, $_POST["confirm"]);

    // Validasi input
    if (empty($username) || empty($password) || empty($confirm)) {
        $status = "error";
        $message = "Semua field wajib diisi.";
    } elseif (strlen($username) < 5) {
        $status = "error";
        $message = "Username harus minimal 5 karakter.";
    } elseif (strlen($password) < 8) {
        $status = "error";
        $message = "Password harus minimal 8 karakter.";
    } elseif (!preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password)) {
        $status = "error";
        $message = "Password harus mengandung huruf besar dan angka.";
    } elseif ($password !== $confirm) {
        $status = "error";
        $message = "Password dan konfirmasi tidak cocok.";
    } else {
        // Cek apakah username sudah ada
        $check_query = "SELECT * FROM users WHERE username = '$username'";
        $check_result = mysqli_query($conn, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            $status = "error";
            $message = "Username sudah digunakan.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed')";

            if (mysqli_query($conn, $query)) {
                header("Location: login.php?registered=true");
                exit;
            } else {
                $status = "error";
                $message = "Gagal mendaftarkan user: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Akun</title>
    <style>
        body {
            background: #f4f4f4;
            font-family: Arial;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 30px;
            max-width: 400px;
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #3b5998;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label { 
            display: block; 
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn {
            background-color: #3b5998;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 4px;
            margin-top: 10px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #2d4373;
        }
        .error {
            color: #e74a3b;
            margin-bottom: 15px;
            text-align: center;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
        }
        .login-link a {
            color: #3b5998;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Register</h2>

    <?php if ($status == "error"): ?>
        <div class="error"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Password (minimal 8 karakter, huruf besar dan angka)</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="confirm" required>
        </div>
        <button type="submit" class="btn">Daftar</button>
    </form>
    
    <div class="login-link">
        Sudah punya akun? <a href="login.php">Login disini</a>
    </div>
</div>
</body>
</html>
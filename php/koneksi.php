<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_admin";
$port = 3306; // Tambahkan port di sini

// Membuat koneksi dengan error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    // Tambahkan $port ke dalam parameter mysqli_connect
    $conn = mysqli_connect($host, $user, $pass, $db, $port);

    // Set charset untuk mencegah SQL injection
    mysqli_set_charset($conn, "utf8mb4");
} catch (mysqli_sql_exception $e) {
    // Log error ke file daripada menampilkan ke user
    error_log("Koneksi database gagal: " . $e->getMessage());

    // Tampilkan pesan error yang ramah pengguna
    die("Maaf, terjadi kesalahan pada sistem. Silakan coba lagi nanti.");
}

<?php
$host = getenv('DB_HOST') ?: "db";
$user = getenv('DB_USER') ?: "root";
$pass = getenv('DB_PASSWORD') ?: "";
$db   = getenv('DB_NAME') ?: "db_admin";
$port = getenv('DB_PORT') ?: 3306; // Default port in Docker

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

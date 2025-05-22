<?php
$host = "localhost"; // Will be replaced by Docker entrypoint.sh
$user = "root";
$pass = "";
$db   = "db_admin";
$port = 3306; // Matches docker-compose.yml default

// Membuat koneksi dengan error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    // Tambahkan $port ke dalam parameter mysqli_connect
    $conn = mysqli_connect($host, $user, $pass, $db, $port);

    // Set charset untuk mencegah SQL injection
    mysqli_set_charset($conn, "utf8mb4");

    // Verify connection
    if (!$conn) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }
} catch (Exception $e) {
    // Log error ke file daripada menampilkan ke user
    error_log("Koneksi database gagal: " . $e->getMessage());

    // Tampilkan pesan error yang ramah pengguna
    die("Maaf, terjadi kesalahan pada sistem. Silakan coba lagi nanti.");
}

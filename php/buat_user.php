<?php
include "koneksi.php";

// Ganti sesuai dengan user yang ingin kamu buat
$username = "admin";
$password = password_hash("123456", PASSWORD_DEFAULT); // Hash password

$query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
if (mysqli_query($conn, $query)) {
    echo "User berhasil ditambahkan.";
} else {
    echo "Gagal menambahkan user: " . mysqli_error($conn);
}
?>

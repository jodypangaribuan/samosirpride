<?php
include "koneksi.php";

// Ganti sesuai dengan user yang ingin kamu buat
$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT); // Hash password

// Check if the user already exists
$check_query = "SELECT * FROM users WHERE username = '$username'";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "User sudah ada.";
} else {
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $query)) {
        echo "User berhasil ditambahkan.";
    } else {
        echo "Gagal menambahkan user: " . mysqli_error($conn);
    }
}

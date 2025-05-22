<?php
include 'koneksi.php'; // pastikan variabelnya adalah $koneksi atau ganti jadi $conn di seluruh file

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Ambil nama file gambar
    $get = mysqli_query($conn, "SELECT gambar FROM galeri WHERE id = $id");
    $data = mysqli_fetch_assoc($get);

    // Pastikan file gambar ada dan hapus
    $file_path = "../uploads/" . $data['gambar'];
    if ($data && file_exists($file_path)) {
        unlink($file_path); // hapus file dari server
    }

    // Hapus dari database
    mysqli_query($conn, "DELETE FROM galeri WHERE id = $id");
}

header("Location: galeri.php");
exit;

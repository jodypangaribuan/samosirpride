-- Create database if not exists
CREATE DATABASE IF NOT EXISTS db_admin;
USE db_admin;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert admin user
INSERT INTO users (username, password) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
-- Note: password is 'password', hashed with bcrypt

-- Jemaat (Congregation) table
CREATE TABLE IF NOT EXISTS jemaat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT,
    no_hp VARCHAR(20),
    email VARCHAR(100),
    tanggal_lahir DATE,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan'),
    status ENUM('Aktif', 'Tidak Aktif') DEFAULT 'Aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Ayat Harian (Daily Verse) table
CREATE TABLE IF NOT EXISTS ayat_harian (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    isi TEXT NOT NULL,
    kitab VARCHAR(100),
    ayat VARCHAR(50),
    gambar VARCHAR(255),
    tanggal_dibuat DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Gambar Ayat (Verse Images) table
CREATE TABLE IF NOT EXISTS gambar_ayat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_gambar VARCHAR(255) NOT NULL,
    file_gambar VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Program Pelayanan (Service Program) table
CREATE TABLE IF NOT EXISTS program_pelayanan (
    no INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    tanggal DATE,
    gambar VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Jadwal Ibadah (Worship Schedule) table
CREATE TABLE IF NOT EXISTS jadwal_ibadah (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hari VARCHAR(50) NOT NULL,
    jam VARCHAR(50) NOT NULL,
    tempat VARCHAR(255),
    keterangan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Warta Jemaat (Congregation News) table
CREATE TABLE IF NOT EXISTS warta_jemaat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    tanggal DATE NOT NULL,
    file_pdf VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Galeri (Gallery) table
CREATE TABLE IF NOT EXISTS galeri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Kategori Struktur Gereja (Church Structure Category) table
CREATE TABLE IF NOT EXISTS kategori_struktur_gereja (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Struktur Gereja (Church Structure) table
CREATE TABLE IF NOT EXISTS struktur_gereja (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_kategori INT,
    nama VARCHAR(255) NOT NULL,
    jabatan VARCHAR(255),
    foto VARCHAR(255),
    periode VARCHAR(100),
    FOREIGN KEY (id_kategori) REFERENCES kategori_struktur_gereja(id) ON DELETE SET NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Remaja Naposo (Youth) table
CREATE TABLE IF NOT EXISTS remaja_naposo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255),
    tanggal DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Koor (Choir) table
CREATE TABLE IF NOT EXISTS koor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Acara Koor (Choir Events) table
CREATE TABLE IF NOT EXISTS acara_koor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_koor INT,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    tanggal DATE,
    tempat VARCHAR(255),
    gambar VARCHAR(255),
    FOREIGN KEY (id_koor) REFERENCES koor(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Event Galeri (Gallery Events) table
CREATE TABLE IF NOT EXISTS event_galeri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    tanggal DATE,
    tempat VARCHAR(255),
    gambar VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Peta (Map) table
CREATE TABLE IF NOT EXISTS peta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    alamat TEXT,
    link_google_maps TEXT,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); 
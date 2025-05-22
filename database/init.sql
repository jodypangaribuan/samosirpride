-- Initialize the database
CREATE DATABASE IF NOT EXISTS db_admin;
USE db_admin;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert admin user (default password: admin123)
INSERT INTO users (username, password) VALUES ('admin', '$2y$10$u8YFJsrBPgEvU2QiWOjzE.LcZaDBUbfkRzqaqRTPsQYXh1x/hjUT6');

-- Jemaat table
CREATE TABLE IF NOT EXISTS jemaat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(20),
    email VARCHAR(255),
    tanggal_lahir DATE,
    tanggal_bergabung DATE,
    status VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Ayat Harian table
CREATE TABLE IF NOT EXISTS ayat_harian (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kitab VARCHAR(100) NOT NULL,
    pasal INT NOT NULL,
    ayat_awal INT NOT NULL,
    ayat_akhir INT,
    isi_ayat TEXT NOT NULL,
    judul VARCHAR(255),
    renungan TEXT,
    tanggal_dibuat DATE DEFAULT CURRENT_DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Program Pelayanan table
CREATE TABLE IF NOT EXISTS program_pelayanan (
    no INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    tanggal DATE NOT NULL,
    deskripsi TEXT,
    lokasi VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Struktur Gereja table
CREATE TABLE IF NOT EXISTS struktur_gereja (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    jabatan VARCHAR(255) NOT NULL,
    foto VARCHAR(255),
    deskripsi TEXT,
    kategori_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Kategori Struktur Gereja table
CREATE TABLE IF NOT EXISTS kategori_struktur_gereja (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Jadwal Ibadah table
CREATE TABLE IF NOT EXISTS jadwal_ibadah (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tanggal DATE NOT NULL,
    jam VARCHAR(20) NOT NULL,
    tema VARCHAR(255),
    pembicara VARCHAR(255),
    lokasi VARCHAR(255),
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Galeri table
CREATE TABLE IF NOT EXISTS galeri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    gambar VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    event_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Event Galeri table
CREATE TABLE IF NOT EXISTS event_galeri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_event VARCHAR(255) NOT NULL,
    tanggal DATE,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Gambar Ayat table
CREATE TABLE IF NOT EXISTS gambar_ayat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ayat_id INT,
    gambar VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Warta Jemaat table
CREATE TABLE IF NOT EXISTS warta_jemaat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    file VARCHAR(255) NOT NULL,
    tanggal DATE NOT NULL,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Remaja Naposo table
CREATE TABLE IF NOT EXISTS remaja_naposo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    gambar VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Koor table
CREATE TABLE IF NOT EXISTS koor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    foto VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Acara Koor table
CREATE TABLE IF NOT EXISTS acara_koor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    tanggal DATE NOT NULL,
    lokasi VARCHAR(255),
    deskripsi TEXT,
    koor_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Peta table
CREATE TABLE IF NOT EXISTS peta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    alamat TEXT NOT NULL,
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create directories for uploads
-- These will be managed by the PHP code, not the SQL 
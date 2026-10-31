-- Database: Sistem Informasi Data Mahasiswa
CREATE DATABASE IF NOT EXISTS db_mahasiswa
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_mahasiswa;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(10) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    jurusan VARCHAR(100) NOT NULL,
    angkatan YEAR NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Akun demo: username=admin, password=admin123
INSERT INTO users (username, password)
VALUES ('admin', '$2y$12$KDsGYL7rTZtfQtYKDDilT.LMXMRWbceSR0EXEsQifqDXpNcAdKCIm')
ON DUPLICATE KEY UPDATE username = VALUES(username);

-- Data contoh agar tabel dashboard tidak kosong saat pertama dijalankan.
INSERT INTO mahasiswa (nim, nama, email, jurusan, angkatan) VALUES
('2022120015', 'Budi Santoso', 'budi.santoso@example.com', 'Teknik Elektro', 2022),
('2023110002', 'Siti Rahmawati', 'siti.rahmawati@example.com', 'Sistem Informasi', 2023),
('2023110001', 'Ahmad Fauzi', 'ahmad.fauzi@example.com', 'Teknik Informatika', 2023)
ON DUPLICATE KEY UPDATE nim = VALUES(nim);

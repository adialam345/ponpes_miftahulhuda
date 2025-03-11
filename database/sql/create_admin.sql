-- Pastikan database sudah dibuat
CREATE DATABASE IF NOT EXISTS ponpes_miftalhuda;
USE ponpes_miftalhuda;

-- Buat tabel users jika belum ada
CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100),
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Masukkan data admin
-- Password: admin (sudah di-hash dengan bcrypt)
INSERT INTO users (name, username, password, created_at, updated_at)
VALUES (
    'Administrator',
    'admin',
    '$2y$12$wkFkz0jPHACtb09xpI6K6OZVmKviiwL7UDHpxKAcMDKpWNYMfeKOW',
    NOW(),
    NOW()
); 
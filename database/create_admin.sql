-- Buat database jika belum ada
CREATE DATABASE IF NOT EXISTS ponpes_miftalhuda;
USE ponpes_miftalhuda;

-- Buat tabel users
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Masukkan data admin
-- Password: admin (hashed dengan bcrypt)
INSERT INTO users (name, username, password, created_at, updated_at)
VALUES (
    'Administrator',
    'admin',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    NOW(),
    NOW()
); 
-- Hapus dan buat ulang database
DROP DATABASE IF EXISTS ponpes_miftalhuda;
CREATE DATABASE ponpes_miftalhuda;
USE ponpes_miftalhuda;

-- Buat tabel users
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Masukkan data admin dengan password yang sudah di-hash
INSERT INTO users (name, username, password, created_at, updated_at)
VALUES (
    'Administrator',
    'admin',
    '$2y$12$UTQOKhvKk7eV8qnscJYb1.FGD8XvH6h.V.MWS6qWtW8sRVBGvpiHO',
    NOW(),
    NOW()
); 
/*
-- 1. Buat Tabel Users
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    role VARCHAR(50) NOT NULL DEFAULT 'reader',
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 2. Buat Tabel Comics
CREATE TABLE comics (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    cover VARCHAR(255) NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'Ongoing',
    author VARCHAR(255) NOT NULL,
    genre TEXT NOT NULL,
    synopsis TEXT NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 3. Buat Tabel Chapters (Memiliki Relasi ke Tabel Comics)
CREATE TABLE chapters (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    comic_id BIGINT UNSIGNED NOT NULL,
    chapter_number INT NOT NULL,
    chapter_title VARCHAR(255) NULL,
    content_images TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (comic_id) REFERENCES comics(id) ON DELETE CASCADE
); */


INSERT INTO users (name, email, password, role, created_at, updated_at) 
VALUES (
    'dava', 
    'dava@komikhub.com', 
    '$2y$12$7I12C.4zCTZoLVh5S/8vQOCCsVNmuxd10sMHMhmsfZgUMOyGRNvii', 
    'admin', 
    NOW(), 
    NOW()
);
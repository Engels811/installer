-- ============================================================
-- Migration: 001_users
-- ============================================================

CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(150) NOT NULL,
        email VARCHAR(190) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        status VARCHAR(50) DEFAULT 'active',
        last_login_at DATETIME NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

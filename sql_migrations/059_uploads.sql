-- ============================================================
-- Migration: 059_uploads
-- ============================================================

CREATE TABLE IF NOT EXISTS uploads (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NULL,
        path VARCHAR(255) NOT NULL,
        type VARCHAR(150) NOT NULL,
        size INT DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

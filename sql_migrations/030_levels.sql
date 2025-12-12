-- ============================================================
-- Migration: 030_levels
-- ============================================================

CREATE TABLE IF NOT EXISTS levels (
        id INT AUTO_INCREMENT PRIMARY KEY,
        level INT NOT NULL UNIQUE,
        required_xp INT NOT NULL,
        reward VARCHAR(255) NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

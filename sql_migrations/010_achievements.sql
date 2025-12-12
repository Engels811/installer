-- ============================================================
-- Migration: 010_achievements
-- ============================================================

CREATE TABLE IF NOT EXISTS achievements (
        id INT AUTO_INCREMENT PRIMARY KEY,
        code VARCHAR(150) NOT NULL UNIQUE,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        rarity VARCHAR(50) NOT NULL,
        points INT DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

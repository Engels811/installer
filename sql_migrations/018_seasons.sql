-- ============================================================
-- Migration: 018_seasons
-- ============================================================

CREATE TABLE IF NOT EXISTS seasons (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(150) NOT NULL,
        code VARCHAR(150) NOT NULL UNIQUE,
        starts_at DATETIME NOT NULL,
        ends_at DATETIME NOT NULL,
        multiplier DECIMAL(5,2) DEFAULT 1.00,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

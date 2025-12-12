-- ============================================================
-- Migration: 029_xp_sources
-- ============================================================

CREATE TABLE IF NOT EXISTS xp_sources (
        id INT AUTO_INCREMENT PRIMARY KEY,
        code VARCHAR(150) NOT NULL UNIQUE,
        description VARCHAR(255),
        multiplier DECIMAL(5,2) DEFAULT 1.00,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

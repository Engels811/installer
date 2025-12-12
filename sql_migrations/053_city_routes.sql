-- ============================================================
-- Migration: 053_city_routes
-- ============================================================

CREATE TABLE IF NOT EXISTS city_routes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        payout INT DEFAULT 0,
        cooldown_seconds INT DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

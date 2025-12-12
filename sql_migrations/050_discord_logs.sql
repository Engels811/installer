-- ============================================================
-- Migration: 050_discord_logs
-- ============================================================

CREATE TABLE IF NOT EXISTS discord_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        guild_id VARCHAR(150) NULL,
        event VARCHAR(255) NOT NULL,
        meta JSON NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

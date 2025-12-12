-- ============================================================
-- Migration: 049_discord_guild_settings
-- ============================================================

CREATE TABLE IF NOT EXISTS discord_guild_settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        guild_id VARCHAR(150) NOT NULL UNIQUE,
        prefix VARCHAR(10) DEFAULT '!',
        locale VARCHAR(10) DEFAULT 'de',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

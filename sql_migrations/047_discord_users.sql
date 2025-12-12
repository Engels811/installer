-- ============================================================
-- Migration: 047_discord_users
-- ============================================================

CREATE TABLE IF NOT EXISTS discord_users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        discord_id VARCHAR(150) NOT NULL UNIQUE,
        username VARCHAR(255) NOT NULL,
        linked_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

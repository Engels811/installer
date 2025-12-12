-- ============================================================
-- Migration: 051_city_players
-- ============================================================

CREATE TABLE IF NOT EXISTS city_players (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fivem_id VARCHAR(150) NOT NULL UNIQUE,
        user_id INT NULL,
        money INT DEFAULT 0,
        xp INT DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

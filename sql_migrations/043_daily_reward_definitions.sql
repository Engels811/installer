-- ============================================================
-- Migration: 043_daily_reward_definitions
-- ============================================================

CREATE TABLE IF NOT EXISTS daily_reward_definitions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        rarity VARCHAR(50) NOT NULL,
        reward VARCHAR(255) NOT NULL,
        xp_award INT DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

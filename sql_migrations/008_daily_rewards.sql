-- ============================================================
-- Migration: 008_daily_rewards
-- ============================================================

CREATE TABLE IF NOT EXISTS daily_rewards (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        rarity VARCHAR(50) NOT NULL,
        reward VARCHAR(255) NOT NULL,
        xp_awarded INT DEFAULT 0,
        claimed_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

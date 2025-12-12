-- ============================================================
-- Migration: 011_achievement_user
-- ============================================================

CREATE TABLE IF NOT EXISTS achievement_user (
        achievement_id INT NOT NULL,
        user_id INT NOT NULL,
        unlocked_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY(achievement_id, user_id),
        FOREIGN KEY (achievement_id) REFERENCES achievements(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

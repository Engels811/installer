-- ============================================================
-- Migration: 031_prestige_tracks
-- ============================================================

CREATE TABLE IF NOT EXISTS prestige_tracks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        prestige_level INT DEFAULT 0,
        earned_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

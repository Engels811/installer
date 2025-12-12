-- ============================================================
-- Migration: 062_fm_tracks
-- ============================================================

CREATE TABLE IF NOT EXISTS fm_tracks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        artist VARCHAR(255) NULL,
        url VARCHAR(255) NOT NULL,
        duration INT DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

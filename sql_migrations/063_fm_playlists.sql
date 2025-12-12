-- ============================================================
-- Migration: 063_fm_playlists
-- ============================================================

CREATE TABLE IF NOT EXISTS fm_playlists (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

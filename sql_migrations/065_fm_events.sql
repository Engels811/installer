-- ============================================================
-- Migration: 065_fm_events
-- ============================================================

CREATE TABLE IF NOT EXISTS fm_events (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NULL,
        starts_at DATETIME NOT NULL,
        ends_at DATETIME NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

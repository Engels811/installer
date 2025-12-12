-- ============================================================
-- Migration: 019_season_events
-- ============================================================

CREATE TABLE IF NOT EXISTS season_events (
        id INT AUTO_INCREMENT PRIMARY KEY,
        season_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        starts_at DATETIME NOT NULL,
        ends_at DATETIME NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (season_id) REFERENCES seasons(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

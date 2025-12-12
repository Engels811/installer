-- ============================================================
-- Migration: 052_city_logs
-- ============================================================

CREATE TABLE IF NOT EXISTS city_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        player_id INT NULL,
        action VARCHAR(150) NOT NULL,
        meta JSON NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (player_id) REFERENCES city_players(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

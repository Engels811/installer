-- ============================================================
-- Migration: 054_city_inventory
-- ============================================================

CREATE TABLE IF NOT EXISTS city_inventory (
        id INT AUTO_INCREMENT PRIMARY KEY,
        player_id INT NOT NULL,
        item VARCHAR(150) NOT NULL,
        amount INT DEFAULT 1,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (player_id) REFERENCES city_players(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

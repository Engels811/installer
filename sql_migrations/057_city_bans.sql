-- ============================================================
-- Migration: 057_city_bans
-- ============================================================

CREATE TABLE IF NOT EXISTS city_bans (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fivem_id VARCHAR(150) NOT NULL,
        reason TEXT NOT NULL,
        banned_by INT NULL,
        banned_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        expires_at DATETIME NULL,
        FOREIGN KEY (banned_by) REFERENCES users(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

-- ============================================================
-- Migration: 009_xp_logs
-- ============================================================

CREATE TABLE IF NOT EXISTS xp_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        amount INT NOT NULL,
        source VARCHAR(150) NOT NULL,
        notes VARCHAR(255) NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

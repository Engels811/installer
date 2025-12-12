-- ============================================================
-- Migration: 025_login_logs
-- ============================================================

CREATE TABLE IF NOT EXISTS login_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NULL,
        ip VARCHAR(64) NULL,
        status VARCHAR(50) NOT NULL,
        user_agent TEXT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

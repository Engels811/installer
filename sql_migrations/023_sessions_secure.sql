-- ============================================================
-- Migration: 023_sessions_secure
-- ============================================================

CREATE TABLE IF NOT EXISTS sessions_secure (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        session_token VARCHAR(190) NOT NULL UNIQUE,
        ip VARCHAR(64) NULL,
        user_agent TEXT NULL,
        last_activity DATETIME NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

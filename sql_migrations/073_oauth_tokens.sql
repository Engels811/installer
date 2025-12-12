-- ============================================================
-- Migration: 073_oauth_tokens
-- ============================================================

CREATE TABLE IF NOT EXISTS oauth_tokens (
        id INT AUTO_INCREMENT PRIMARY KEY,
        client_id INT NOT NULL,
        user_id INT NOT NULL,
        token VARCHAR(255) NOT NULL UNIQUE,
        expires_at DATETIME NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (client_id) REFERENCES oauth_clients(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

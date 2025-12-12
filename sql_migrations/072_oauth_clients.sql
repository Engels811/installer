-- ============================================================
-- Migration: 072_oauth_clients
-- ============================================================

CREATE TABLE IF NOT EXISTS oauth_clients (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(150) NOT NULL,
        client_id VARCHAR(255) NOT NULL UNIQUE,
        secret VARCHAR(255) NOT NULL,
        redirect_uri VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

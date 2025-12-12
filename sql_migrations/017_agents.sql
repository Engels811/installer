-- ============================================================
-- Migration: 017_agents
-- ============================================================

CREATE TABLE IF NOT EXISTS agents (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(150) NOT NULL,
        token VARCHAR(190) NOT NULL UNIQUE,
        status VARCHAR(50) DEFAULT 'offline',
        last_seen_at DATETIME NULL,
        notes TEXT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

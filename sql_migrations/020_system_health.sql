-- ============================================================
-- Migration: 020_system_health
-- ============================================================

CREATE TABLE IF NOT EXISTS system_health (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(150) NOT NULL,
        status VARCHAR(50) NOT NULL,
        meta JSON NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

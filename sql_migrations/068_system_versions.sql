-- ============================================================
-- Migration: 068_system_versions
-- ============================================================

CREATE TABLE IF NOT EXISTS system_versions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        version VARCHAR(50) NOT NULL,
        description TEXT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

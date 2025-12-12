-- ============================================================
-- Migration: 044_monitor_checks
-- ============================================================

CREATE TABLE IF NOT EXISTS monitor_checks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(150) NOT NULL,
        type VARCHAR(50) NOT NULL,
        target VARCHAR(255) NOT NULL,
        interval_seconds INT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

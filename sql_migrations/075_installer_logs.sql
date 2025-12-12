-- ============================================================
-- Migration: 075_installer_logs
-- ============================================================

CREATE TABLE IF NOT EXISTS installer_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        step VARCHAR(150) NOT NULL,
        message TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

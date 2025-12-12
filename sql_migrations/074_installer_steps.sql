-- ============================================================
-- Migration: 074_installer_steps
-- ============================================================

CREATE TABLE IF NOT EXISTS installer_steps (
        id INT AUTO_INCREMENT PRIMARY KEY,
        step VARCHAR(150) NOT NULL,
        status VARCHAR(50) DEFAULT 'pending',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

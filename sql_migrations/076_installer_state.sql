-- ============================================================
-- Migration: 076_installer_state
-- ============================================================

CREATE TABLE IF NOT EXISTS installer_state (
        id INT AUTO_INCREMENT PRIMARY KEY,
        is_installed TINYINT(1) DEFAULT 0,
        installed_at DATETIME NULL,
        version VARCHAR(50) NULL,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

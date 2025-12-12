-- ============================================================
-- Migration: 069_system_backups
-- ============================================================

CREATE TABLE IF NOT EXISTS system_backups (
        id INT AUTO_INCREMENT PRIMARY KEY,
        file VARCHAR(255) NOT NULL,
        size INT NOT NULL,
        created_by INT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

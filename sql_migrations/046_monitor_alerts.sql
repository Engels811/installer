-- ============================================================
-- Migration: 046_monitor_alerts
-- ============================================================

CREATE TABLE IF NOT EXISTS monitor_alerts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        check_id INT NOT NULL,
        status VARCHAR(50) NOT NULL,
        message TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (check_id) REFERENCES monitor_checks(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

-- ============================================================
-- Migration: 045_monitor_results
-- ============================================================

CREATE TABLE IF NOT EXISTS monitor_results (
        id INT AUTO_INCREMENT PRIMARY KEY,
        check_id INT NOT NULL,
        status VARCHAR(50) NOT NULL,
        response_time INT NULL,
        message TEXT NULL,
        checked_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (check_id) REFERENCES monitor_checks(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

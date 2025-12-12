-- ============================================================
-- Migration: 037_realtime_events
-- ============================================================

CREATE TABLE IF NOT EXISTS realtime_events (
        id INT AUTO_INCREMENT PRIMARY KEY,
        channel VARCHAR(150) NOT NULL,
        payload JSON NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

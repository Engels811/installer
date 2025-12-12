-- ============================================================
-- Migration: 071_api_rate_limits
-- ============================================================

CREATE TABLE IF NOT EXISTS api_rate_limits (
        id INT AUTO_INCREMENT PRIMARY KEY,
        key_id INT NOT NULL,
        requests INT DEFAULT 0,
        window_start DATETIME NOT NULL,
        FOREIGN KEY (key_id) REFERENCES api_keys(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

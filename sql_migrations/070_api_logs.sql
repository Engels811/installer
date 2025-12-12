-- ============================================================
-- Migration: 070_api_logs
-- ============================================================

CREATE TABLE IF NOT EXISTS api_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        api_key_id INT NULL,
        endpoint VARCHAR(255) NOT NULL,
        method VARCHAR(10) NOT NULL,
        response_code INT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (api_key_id) REFERENCES api_keys(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

-- ============================================================
-- Migration: 034_agent_logs
-- ============================================================

CREATE TABLE IF NOT EXISTS agent_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        agent_id INT NOT NULL,
        event VARCHAR(255) NOT NULL,
        meta JSON NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (agent_id) REFERENCES agents(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

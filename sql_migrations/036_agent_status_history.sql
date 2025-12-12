-- ============================================================
-- Migration: 036_agent_status_history
-- ============================================================

CREATE TABLE IF NOT EXISTS agent_status_history (
        id INT AUTO_INCREMENT PRIMARY KEY,
        agent_id INT NOT NULL,
        status VARCHAR(50) NOT NULL,
        changed_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (agent_id) REFERENCES agents(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

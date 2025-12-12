-- ============================================================
-- Migration: 035_agent_events
-- ============================================================

CREATE TABLE IF NOT EXISTS agent_events (
        id INT AUTO_INCREMENT PRIMARY KEY,
        agent_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (agent_id) REFERENCES agents(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

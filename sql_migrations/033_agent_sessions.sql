-- ============================================================
-- Migration: 033_agent_sessions
-- ============================================================

CREATE TABLE IF NOT EXISTS agent_sessions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        agent_id INT NOT NULL,
        status VARCHAR(50) DEFAULT 'active',
        started_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        ended_at DATETIME NULL,
        FOREIGN KEY (agent_id) REFERENCES agents(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

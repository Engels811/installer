-- ============================================================
-- Migration: 041_ticket_logs
-- ============================================================

CREATE TABLE IF NOT EXISTS ticket_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ticket_id INT NOT NULL,
        action VARCHAR(255) NOT NULL,
        meta JSON NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

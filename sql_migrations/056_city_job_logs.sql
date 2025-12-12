-- ============================================================
-- Migration: 056_city_job_logs
-- ============================================================

CREATE TABLE IF NOT EXISTS city_job_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        job_id INT NOT NULL,
        player_id INT NULL,
        action VARCHAR(150) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (job_id) REFERENCES city_jobs(id) ON DELETE CASCADE,
        FOREIGN KEY (player_id) REFERENCES city_players(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

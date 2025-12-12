-- ============================================================
-- Migration: 055_city_jobs
-- ============================================================

CREATE TABLE IF NOT EXISTS city_jobs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(150) NOT NULL,
        salary INT DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

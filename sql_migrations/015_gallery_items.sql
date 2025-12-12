-- ============================================================
-- Migration: 015_gallery_items
-- ============================================================

CREATE TABLE IF NOT EXISTS gallery_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        path VARCHAR(255) NOT NULL,
        visibility VARCHAR(50) DEFAULT 'public',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

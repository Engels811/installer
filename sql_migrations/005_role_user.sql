-- ============================================================
-- Migration: 005_role_user
-- ============================================================

CREATE TABLE IF NOT EXISTS role_user (
        role_id INT NOT NULL,
        user_id INT NOT NULL,
        PRIMARY KEY(role_id, user_id),
        FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

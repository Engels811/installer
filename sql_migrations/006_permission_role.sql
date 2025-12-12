-- ============================================================
-- Migration: 006_permission_role
-- ============================================================

CREATE TABLE IF NOT EXISTS permission_role (
        permission_id INT NOT NULL,
        role_id INT NOT NULL,
        PRIMARY KEY(permission_id, role_id),
        FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE,
        FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;;

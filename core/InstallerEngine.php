<?php

class InstallerEngine
{
    private PDO $db;

    public function __construct($host, $user, $pass, $dbname, $port)
    {
        $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";

        $this->db = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public function runMigrations(): void
    {
        $sqlPath = __DIR__ . "/../sql";

        if (!is_dir($sqlPath)) return;

        foreach (glob($sqlPath . "/*.sql") as $file) {
            $query = file_get_contents($file);
            $this->db->exec($query);
        }
    }

    public function createAdmin($username, $email, $password): void
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, role) VALUES (?,?,?, 'admin')");
        $stmt->execute([$username, $email, $hash]);
    }

    public function lockInstaller(): void
    {
        file_put_contents(__DIR__ . "/../config/installer.lock", "1");
    }
}

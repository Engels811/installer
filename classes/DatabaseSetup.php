<?php
/* ============================================================
   WONDERLIFE INSTALLER — DATABASE TEST CLASS (FINAL)
============================================================ */

class DatabaseSetup
{
    public static function testConnection($host, $user, $pass, $dbname, $port = 3306): array
    {
        // Host fallback
        if (trim($host) === "") {
            $host = "localhost";
        }

        // DB Name benötigt
        if (trim($dbname) === "") {
            return [
                'status'  => 'error',
                'message' => 'Database name is required.'
            ];
        }

        try {
            $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";

            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_TIMEOUT            => 3
            ]);

            // Test-Abfrage
            $pdo->query("SELECT 1");

            return [
                'status'  => 'ok',
                'message' => "Connection successful"
            ];

        } catch (PDOException $e) {
            return [
                'status'  => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}

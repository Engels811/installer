<?php
header("Content-Type: application/json");
session_start();

$log = [];

/* ---------------------------------------------------------
   CHECK REQUIRED SESSION VALUES
--------------------------------------------------------- */
$keys = ["db_host", "db_user", "db_pass", "db_name", "db_port"];
foreach ($keys as $k) {
    if (empty($_SESSION[$k])) {
        echo json_encode([
            "status" => "error",
            "message" => "Missing installer value: $k",
            "log" => []
        ]);
        exit;
    }
}

/* ---------------------------------------------------------
   CONNECT TO MYSQL SERVER
--------------------------------------------------------- */
try {
    $log[] = "Verbinde mit MySQL-Server…";

    $pdo = new PDO(
        "mysql:host={$_SESSION['db_host']};port={$_SESSION['db_port']};charset=utf8mb4",
        $_SESSION['db_user'],
        $_SESSION['db_pass'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $log[] = "Verbindung erfolgreich ✓";

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Database connection failed",
        "log" => array_merge($log, [$e->getMessage()])
    ]);
    exit;
}

/* ---------------------------------------------------------
   CREATE + SELECT DATABASE
--------------------------------------------------------- */
try {
    $dbName = $_SESSION["db_name"];

    $log[] = "Prüfe Datenbank `$dbName`…";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    $pdo->exec("USE `$dbName`;");

    $log[] = "Datenbank bereit ✓";

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed creating/selecting database",
        "log" => array_merge($log, [$e->getMessage()])
    ]);
    exit;
}

/* ---------------------------------------------------------
   LOAD ALL SQL FILES FROM sql_migrations
--------------------------------------------------------- */
$sqlDir = __DIR__ . "/../sql_migrations/";
$files = glob($sqlDir . "*.sql");

if (!$files) {
    echo json_encode([
        "status" => "error",
        "message" => "Keine SQL-Migrationsdateien gefunden!",
        "log" => $log
    ]);
    exit;
}

natcasesort($files); // Sort 001 → 002 → 003 …

$log[] = "Gefundene SQL-Dateien: " . count($files);

$index = 1;
$total = count($files);

foreach ($files as $file) {
    $name = basename($file);

    $log[] = "($index/$total) Lade $name …";

    $sql = file_get_contents($file);

    try {
        $pdo->exec($sql);
        $log[] = " → $name erfolgreich ausgeführt ✓";
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Fehler beim Ausführen von $name",
            "log" => array_merge($log, [$e->getMessage()])
        ]);
        exit;
    }

    usleep(300000); // Animation
    $index++;
}

/* ---------------------------------------------------------
   FINISH
--------------------------------------------------------- */

$log[] = "Alle Migrationen erfolgreich abgeschlossen ✓";
$log[] = "Datenbank-Setup vollständig.";

// SUCCESS
echo json_encode([
    "status" => "ok",
    "message" => "Migration completed",
    "log" => $log
]);
exit;

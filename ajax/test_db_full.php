<?php
/* ============================================================
   WONDERLIFE INSTALLER — FULL DATABASE DIAGNOSTICS (FINAL v1)
============================================================ */

if (!isset($_SESSION)) session_start();

header("Content-Type: application/json; charset=utf-8");

require_once __DIR__ . '/../classes/DatabaseSetup.php';

/* ------------------------------------------------------------
   SESSION-WERTE LADEN
------------------------------------------------------------ */
$host = $_SESSION['db_host'] ?? 'localhost';
$user = $_SESSION['db_user'] ?? '';
$pass = $_SESSION['db_pass'] ?? '';
$name = $_SESSION['db_name'] ?? '';

$steps = [];

/* Helper: Step-Text hinzufügen */
function addStep(&$steps, $text) {
    $steps[] = $text;
}

/* ------------------------------------------------------------
   Schritt 1: Eingangsdaten prüfen
------------------------------------------------------------ */
addStep($steps, "Konfiguration prüfen…");

if ($user === "" || $name === "") {
    echo json_encode([
        "success" => false,
        "message" => "FEHLENDE Datenbank-Zugangsdaten.",
        "steps"   => $steps
    ]);
    exit;
}

/* ------------------------------------------------------------
   Schritt 2: Verbindung herstellen
------------------------------------------------------------ */
addStep($steps, "Starte PDO-Initialisierung…");

try {
    $dsn = "mysql:host={$host};dbname={$name};charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT            => 3
    ]);
    addStep($steps, "PDO-Verbindung hergestellt ✓");

} catch (PDOException $e) {
    addStep($steps, "PDO-Fehler: " . $e->getMessage());
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage(),
        "steps"   => $steps
    ]);
    exit;
}

/* ------------------------------------------------------------
   Schritt 3: Ping / SELECT 1
------------------------------------------------------------ */
addStep($steps, "Sende Ping (SELECT 1)…");

try {
    $pdo->query("SELECT 1");
    addStep($steps, "Ping erfolgreich ✓");
} catch (PDOException $e) {
    addStep($steps, "Ping fehlgeschlagen!");
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage(),
        "steps"   => $steps
    ]);
    exit;
}

/* ------------------------------------------------------------
   Schritt 4: Schreibrechte testen
------------------------------------------------------------ */
addStep($steps, "Teste Schreibrechte…");

try {
    $pdo->query("CREATE TEMPORARY TABLE wln_temp_test (id INT)");
    $pdo->query("DROP TABLE wln_temp_test");
    addStep($steps, "Schreibrechte OK ✓");
} catch (PDOException $e) {
    addStep($steps, "Schreibtest NICHT möglich!");
    echo json_encode([
        "success" => false,
        "message" => "Benutzer hat keine CREATE / DROP Berechtigungen.",
        "steps"   => $steps
    ]);
    exit;
}

/* ------------------------------------------------------------
   Schritt 5: MySQL-Infos sammeln
------------------------------------------------------------ */
addStep($steps, "Lese Serverinformationen…");

try {
    $info = $pdo->query("SELECT VERSION() as ver")->fetch();
    addStep($steps, "MySQL-Version: " . ($info['ver'] ?? "unbekannt"));
} catch (PDOException $e) {
    addStep($steps, "Versionsabfrage fehlgeschlagen.");
}

/* ------------------------------------------------------------
   Alles erfolgreich
------------------------------------------------------------ */
addStep($steps, "Datenbankdiagnose abgeschlossen ✓");

echo json_encode([
    "success" => true,
    "steps"   => $steps
]);
exit;

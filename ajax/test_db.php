<?php
/**
 * ============================================================
 * WLN Database Test - AJAX Backend (FINAL, ERROR-FREE)
 * ============================================================
 * Führt einen vollständigen DB-Test durch:
 * - Verbindungsaufbau
 * - Login
 * - DB existiert?
 * - Tabellen zählen
 * - Rechte prüfen
 * - Session aktualisieren
 */

header('Content-Type: application/json; charset=utf-8');

// Session starten
if (!isset($_SESSION)) session_start();

// JSON Input lesen (Terminal ruft JSON auf)
$input = file_get_contents('php://input');
$data  = json_decode($input, true);

// Fallback auf POST (Step 4 ruft POST auf)
if (!$data || !is_array($data)) {
    $data = $_POST ?? [];
}

/* ============================================================
   Session + Request Merging (sauber & eindeutig)
============================================================ */

$host = $data['host'] ?? ($_SESSION['db_host'] ?? 'localhost');
$user = $data['user'] ?? ($_SESSION['db_user'] ?? 'root');
$pass = $data['pass'] ?? ($_SESSION['db_pass'] ?? '');
$name = $data['name'] ?? ($_SESSION['db_name'] ?? '');
$port = $data['port'] ?? ($_SESSION['db_port'] ?? '3306');

/* ============================================================
   Validierung
============================================================ */
if (trim($name) === "") {
    echo json_encode([
        'success'     => false,
        'error'       => 'Database name is required',
        'error_code'  => 'MISSING_DB_NAME'
    ]);
    exit;
}

try {

    /* ============================================================
       1. Verbindung zum MySQL-Server testen
    ============================================================ */
    $dsnServer = "mysql:host=$host;port=$port;charset=utf8mb4";

    $pdoServer = new PDO($dsnServer, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_TIMEOUT            => 3
    ]);

    // MySQL-Version
    $version = $pdoServer->query("SELECT VERSION()")->fetchColumn();


    /* ============================================================
       2. Prüfen, ob die gewünschte Datenbank existiert
    ============================================================ */
    $dbExists    = false;
    $tableCount  = 0;

    try {
        // Verbindung direkt in die Datenbank
        $pdo = new PDO(
            "mysql:host=$host;port=$port;dbname=$name;charset=utf8mb4",
            $user,
            $pass,
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false
            ]
        );

        $dbExists = true;

        // Tabellen zählen
        $stmt = $pdo->query("SHOW TABLES");
        $tableCount = $stmt->rowCount();

    } catch (PDOException $e) {
        // DB existiert nicht – Installer erstellt sie später
        $dbExists = false;
    }


    /* ============================================================
       3. CREATE DATABASE Rechte testen
    ============================================================ */
    $canCreateDB = false;

    try {
        $grants = $pdoServer->query("SHOW GRANTS FOR CURRENT_USER()")
                            ->fetchAll(PDO::FETCH_COLUMN);

        foreach ($grants as $grant) {
            if (
                stripos($grant, "ALL PRIVILEGES") !== false ||
                stripos($grant, "CREATE") !== false
            ) {
                $canCreateDB = true;
                break;
            }
        }

    } catch (PDOException $e) {
        // Kann vorkommen — ignorieren
        $canCreateDB = false;
    }


    /* ============================================================
       4. Erfolgreiche Antwort
    ============================================================ */
    echo json_encode([
        'success'       => true,
        'version'       => $version,
        'db_exists'     => $dbExists,
        'tables'        => $tableCount,
        'can_create_db' => $canCreateDB,
        'host'          => $host,
        'port'          => $port,
        'charset'       => 'utf8mb4',
        'message'       => 'Connection successful'
    ]);


    /* ============================================================
       5. Session aktualisieren
    ============================================================ */
    $_SESSION['db_test_passed'] = true;
    $_SESSION['db_host']        = $host;
    $_SESSION['db_user']        = $user;
    $_SESSION['db_pass']        = $pass;
    $_SESSION['db_name']        = $name;
    $_SESSION['db_port']        = $port;

} catch (PDOException $e) {

    /* ============================================================
       Fehlermeldung zurückgeben
    ============================================================ */
    echo json_encode([
        'success'    => false,
        'error'      => $e->getMessage(),
        'error_code' => $e->getCode(),
        'host'       => $host,
        'port'       => $port
    ]);

    $_SESSION['db_test_passed'] = false;
}

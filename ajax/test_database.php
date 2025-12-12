<?php
/* ============================================================
   WONDERLIFE INSTALLER — AJAX: DATABASE TEST (FINAL)
============================================================ */

if (!isset($_SESSION)) session_start();

require_once __DIR__ . '/../classes/DatabaseSetup.php';

header("Content-Type: application/json; charset=utf-8");

/* Eingaben */
$host = $_POST['host'] ?? 'localhost';
$user = $_POST['user'] ?? '';
$pass = $_POST['pass'] ?? '';
$name = $_POST['name'] ?? '';

/* Minimal-Validierung */
if (trim($name) === "") {
    echo json_encode([
        "status"  => "error",
        "message" => "Database name missing."
    ]);
    exit;
}

/* Test ausführen */
$result = DatabaseSetup::testConnection($host, $user, $pass, $name);

/* Ergebnis zurückgeben */
echo json_encode($result);
exit;

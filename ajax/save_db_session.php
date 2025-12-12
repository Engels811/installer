<?php
/* ============================================================
   WONDERLIFE INSTALLER — AJAX: SAVE DB SESSION (FINAL)
============================================================ */

if (!isset($_SESSION)) session_start();

header("Content-Type: application/json; charset=utf-8");

/* Eingaben holen */
$host = $_POST['host'] ?? 'localhost';
$user = $_POST['user'] ?? '';
$pass = $_POST['pass'] ?? '';
$name = $_POST['name'] ?? '';

/* Minimal-Validierung */
if ($user === "" || $name === "") {
    echo json_encode([
        "success" => false,
        "message" => "Missing required DB fields"
    ]);
    exit;
}

/* Werte speichern */
$_SESSION["db_host"] = $host;
$_SESSION["db_user"] = $user;
$_SESSION["db_pass"] = $pass;
$_SESSION["db_name"] = $name;
$_SESSION["database_configured"] = true;

/* Erfolgsmeldung */
echo json_encode([
    "success" => true,
    "message" => "DB session saved"
]);
exit;

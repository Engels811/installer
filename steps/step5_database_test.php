<?php
header("Content-Type: application/json");

$host = $_POST["host"] ?? "";
$user = $_POST["user"] ?? "";
$pass = $_POST["pass"] ?? "";
$name = $_POST["name"] ?? "";
$port = $_POST["port"] ?? "3306";

// Validation
if (!$host || !$user || !$name) {
    echo json_encode([
        "status"  => "error",
        "success" => false,
        "message" => "Missing required fields"
    ]);
    exit;
}

try {

    // DIRECT PDO CONNECTION TEST
    $dsn = "mysql:host={$host};dbname={$name};port={$port};charset=utf8mb4";

    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // SUCCESS RESPONSE (unified)
    echo json_encode([
        "status"  => "ok",
        "success" => true,
        "message" => "Connection successful"
    ]);
    exit;

} catch (PDOException $e) {

    echo json_encode([
        "status"  => "error",
        "success" => false,
        "message" => $e->getMessage()
    ]);
    exit;
}

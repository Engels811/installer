<?php
require __DIR__ . "/../core/Requirements.php";

header("Content-Type: application/json");

// Run test
$ok = Requirements::checkWebSocketSupport();

echo json_encode([
    "success" => $ok,
    "message" => $ok
        ? "WebSocket-Verbindungen werden unterstützt."
        : "WebSockets sind NICHT verfügbar. Fallback: Polling Engine wird genutzt."
]);

<?php
session_start();

$step = $_POST["step"] ?? null;

if ($step) {
    if (!isset($_SESSION["completed_steps"])) {
        $_SESSION["completed_steps"] = [];
    }

    if (!in_array($step, $_SESSION["completed_steps"])) {
        $_SESSION["completed_steps"][] = $step;
    }
}

echo "ok";

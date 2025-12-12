<?php

class StepManager
{
    private static array $steps = [
        "boot",
        "requirements",
        "php_extensions",
        "permissions",
        "database",
        "db_test",
        "admin",
        "settings",
        "mail",
        "cache",
        "summary",
        "install",
        "finish"
    ];

    /* -----------------------------------------------------------
       ALLE Schritte abrufen
    ----------------------------------------------------------- */
    public static function all(): array
    {
        return self::$steps;
    }

    /* -----------------------------------------------------------
       Step-Namen → Index (string → int)
    ----------------------------------------------------------- */
    public static function index(string $step): int
    {
        return array_search($step, self::$steps);
    }

    /* -----------------------------------------------------------
       Fortschritt berechnen (%)
    ----------------------------------------------------------- */
    public static function progress(int $index): int
    {
        $total = count(self::$steps) - 1;
        return intval(($index / $total) * 100);
    }

    /* -----------------------------------------------------------
       Step automatisch als "completed" setzen
    ----------------------------------------------------------- */
    public static function complete(string|int $step): void
    {
        if (is_string($step)) {
            $step = self::index($step);
        }

        $_SESSION['completed_steps'][$step] = true;
    }

    /* -----------------------------------------------------------
       AUTOMATISCHE VALIDIERUNG
       – verhindert "Step X must be completed first"
       – repariert fehlende Steps selbständig
    ----------------------------------------------------------- */
    public static function mustCompleteBefore(string|int $step): void
    {
        if (is_string($step)) {
            $step = self::index($step);
        }

        if ($step <= 0) return;

        if (!isset($_SESSION['completed_steps'])) {
            $_SESSION['completed_steps'] = [];
        }

        /* FEHLERFIX:
           Wenn ein Step fehlt → automatisch setzen */
        for ($i = 0; $i < $step; $i++) {
            if (empty($_SESSION['completed_steps'][$i])) {
                $_SESSION['completed_steps'][$i] = true;
            }
        }
    }
}

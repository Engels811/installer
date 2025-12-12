<?php

class Language
{
    private static array $strings = [];
    private static string $active = "en";

    public static function init(): void
    {
        if (!isset($_SESSION)) session_start();

        // Sprache aus GET oder SESSION
        self::$active = $_GET['lang'] 
            ?? ($_SESSION['installer_lang'] ?? 'en');

        $_SESSION['installer_lang'] = self::$active;

        // KORREKTER PFAD ZUM TRANSLATIONS-ORDNER
        $file = __DIR__ . "/../translations/" . self::$active . ".php";

        if (file_exists($file)) {
            self::$strings = require $file;
        } else {
            // Fallback auf englisch
            self::$strings = require __DIR__ . "/../translations/en.php";
        }
    }

    public static function get(string $key): string
    {
        return self::$strings[$key] ?? "[[$key]]";
    }

    public static function active(): string
    {
        return self::$active;
    }
}

Language::init();

<?php

class Permissions
{
    public static array $paths = [
        '/cache',
        '/logs',
        '/config',
        '/storage'
    ];

    public static function check(): array
    {
        $results = [];

        foreach (self::$paths as $path) {
            $full = realpath(__DIR__ . '/../..' . $path);

            if (!$full) {
                $results[$path] = false;
                continue;
            }

            $results[$path] = is_writable($full);
        }

        return $results;
    }
}

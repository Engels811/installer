<?php

class Requirements
{
    public static function checkPHP(): bool
    {
        return version_compare(PHP_VERSION, '8.1', '>=');
    }

    public static function getPHPVersion(): string
    {
        return PHP_VERSION;
    }

    public static function checkExtensions(): array
    {
        $required = [
            'pdo_mysql',
            'curl',
            'json',
            'mbstring',
            'openssl',
            'zip',
            'fileinfo'
        ];

        $results = [];

        foreach ($required as $ext) {
            $results[$ext] = extension_loaded($ext);
        }

        // Keine WebSocket-Erkennung mehr
        return $results;
    }
}

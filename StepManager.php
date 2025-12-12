<?php

class StepManager {

    public static function all() {
        return [
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
    }

    public static function progress($index) {
        $total = count(self::all()) - 1;
        return ($index / $total) * 100;
    }

}

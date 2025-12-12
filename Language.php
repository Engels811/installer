<?php

class Language {

    public static function active() {
        return $_SESSION["installer_lang"] ?? "de";
    }

    public static function get($key) {
        global $_GLOBAL_INSTALL;
        $tr = $_GLOBAL_INSTALL["translations"] ?? [];
        return $tr[$key] ?? $key;
    }
}

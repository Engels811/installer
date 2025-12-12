<?php

class ConfigWriter
{
    public static function write(array $settings): bool
    {
        $configFile = __DIR__ . "/../config/generated.config.php";

        $content = "<?php\nreturn " . var_export($settings, true) . ";";

        return file_put_contents($configFile, $content) !== false;
    }
}

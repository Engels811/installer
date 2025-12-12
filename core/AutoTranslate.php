<?php

class AutoTranslate
{
    private static string $apiKey = "HIER_GOOGLE_API_KEY_EINTRAGEN";

    public static function translateMissingKeys(array $de, array $en): array
    {
        foreach ($de as $key => $value) {

            // EN existiert? Weiter
            if (isset($en[$key]) && trim($en[$key]) !== "") {
                continue;
            }

            // Neues EN erzeugen
            $en[$key] = self::translate($value, "de", "en");
        }

        return $en;
    }

    private static function translate(string $text, string $source, string $target): string
    {
        $url = "https://translation.googleapis.com/language/translate/v2?key=" . self::$apiKey;

        $data = [
            "q" => $text,
            "source" => $source,
            "target" => $target,
            "format" => "text"
        ];

        $options = [
            "http" => [
                "header"  => "Content-Type: application/json",
                "method"  => "POST",
                "content" => json_encode($data)
            ]
        ];

        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        $json = json_decode($response, true);

        return $json["data"]["translations"][0]["translatedText"] ?? $text;
    }

    public static function saveFile(array $data, string $langFile)
    {
        $content = "<?php\nreturn " . var_export($data, true) . ";\n";
        file_put_contents($langFile, $content);
    }
}

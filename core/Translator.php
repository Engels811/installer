<?php

class Translator
{
    private static string $api = "https://translate.astian.org/translate";

    public static function translate(string $text, string $target = "en", string $source = "de"): string
    {
        if (trim($text) === "") return $text;

        $payload = json_encode([
            "q"      => $text,
            "source" => $source,
            "target" => $target,
            "format" => "text"
        ]);

        $curl = curl_init(self::$api);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

        $response = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($response, true);

        return $json["translatedText"] ?? $text;
    }
}

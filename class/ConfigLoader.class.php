<?php


namespace webapp_php_sample_class;


class ConfigLoader
{
    private static function validateConfig($file)
    {
        $fileName = explode($file);

        if ($fileName[0] === "config" && $fileName[1] === "json") {
            $config = json_decode($file);

            if ($config[0][0] === "configFile") {
                return $config;
            }
        }
        return false;
    }

    public static function loadConfig($file) {
        $config = self::validateConfig($file);

        if ($config != false) {

        }
    }
}
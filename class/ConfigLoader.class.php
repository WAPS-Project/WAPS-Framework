<?php


namespace webapp_php_sample_class;


class ConfigLoader
{
    public static function loadConfig($path)
    {
        $config = self::validateConfig($path);

        if ($config != false) {

            foreach ($config as $firstLevel) {
                foreach ($firstLevel as $key => $value) {
                    define(strtoupper($key), $value);
                }
            }
            error_reporting(E_ALL);
        }
    }

    private static function validateConfig($path)
    {
        $files = scandir($path);

        foreach ($files as $file) {
            $fileParts = explode('.', $file);

            if ($fileParts[0] === 'config' && $fileParts[1] === 'json') {
                $config = file_get_contents($path . $file);
                $configObj = json_decode($config, true, 512, JSON_THROW_ON_ERROR);

                if ($configObj['head']['title'] === 'configFile') {
                    return $configObj;
                }
            }
        }
        return false;
    }
}
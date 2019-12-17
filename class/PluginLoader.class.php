<?php


namespace webapp_php_sample_class;


use webapp_php_sample_obj\pluginConfigBundle;

class PluginLoader
{
    const PLUGIN_PATH = "./custom/plugin/";

    public static function loadPlugins()
    {
        self::loadPluginConfig();
        $pluginList = array_diff(scandir(self::PLUGIN_PATH), array(".", ".."));
        foreach ($pluginList as $plugin) {
            if (self::checkPluginManifest($plugin)) {
                include self::PLUGIN_PATH . $plugin . "/manifest.php";
            }
        }
    }

    public static function loadPluginConfig()
    {
        $pluginList = array_diff(scandir(self::PLUGIN_PATH), array(".", ".."));
        $configBundle = new pluginConfigBundle();
        foreach ($pluginList as $plugin) {
            if (self::checkPluginManifest($plugin)) {
                $configBundle = new pluginConfigBundle();
                $pluginConfig = file_get_contents(self::PLUGIN_PATH . $plugin . "/config/config.json");
                $configObj = json_decode($pluginConfig, true);
                array_push($configBundle->configList, $configObj);
            }
        }

        $configFile = json_encode($configBundle->configList);
        file_put_contents("./config/plugin.config.json", $configFile);
    }

    protected static function checkPluginManifest($pluginName)
    {
        $pluginContent = scandir(self::PLUGIN_PATH . $pluginName);
        foreach ($pluginContent as $pluginPart) {
            $fileParts = explode(".", $pluginPart);
            if ($fileParts[0] === "manifest") {
                return TRUE;
            }
        }
        return FALSE;
    }
}
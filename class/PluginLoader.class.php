<?php


namespace webapp_php_sample_class;


class PluginLoader
{
    const PLUGIN_PATH = "./custom/plugin/";

    public static function loadPlugins()
    {
        $pluginList = array_diff(scandir(self::PLUGIN_PATH), array(".", ".."));
        foreach ($pluginList as $plugin) {
            if (self::checkPluginManifest($plugin)) {
                include self::PLUGIN_PATH . $plugin . "/manifest.php";
            }
        }
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
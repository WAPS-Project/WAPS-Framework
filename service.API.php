<?php

use webapp_php_sample_class\ConfigLoader;
use webapp_php_sample_class\JsonHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\PluginLoader;
use webapp_php_sample_class\StartUp;

$classString = "class/";
$modelString = "model/";
$configString = "config/";

$objFiles = array_diff(scandir($modelString), array('.', '..'));
$classFiles = array_diff(scandir($classString), array('.', '..'));

foreach ($objFiles as $singleObj) {
    include $modelString . $singleObj;

}
foreach ($classFiles as $singleClass) {
    $classParts = explode(".", $singleClass);
    if ($classParts[1] === "class") {
        include $classString . $singleClass;
    }
}

try {
    ConfigLoader::loadConfig($configString);
} catch (Error $e) {
    JsonHandler::FireSimpleJson($e->getCode(), $e->getMessage());
}

try {
    $command = Main::checkPost("svmode");
    if ($command === NULL) {
        $command = DEFAULT_STRING;
    }
} catch (Error $e) {
    $command = DEFAULT_STRING;
}

try {
    switch ($command) {
        case "pageList":
            StartUp::loadPages();
            JsonHandler::FireSimpleJson("done", "valid");
            break;
        case "pluginList":
            PluginLoader::loadPluginConfig();
            JsonHandler::FireSimpleJson("done", "valid");
            break;
        default:
            JsonHandler::FireSimpleJson("No content warning", "Your request contains no valid Data");
            break;
    }

} catch (Error $e) {
    JsonHandler::FireSimpleJson($e->getCode(), $e->getMessage());
}
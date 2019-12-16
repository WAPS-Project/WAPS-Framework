<?php

$classString ="../class/";
$modelString ="../model/";
$configString = "../config/";

$classList = scandir($classString);
$objList = scandir($modelString);
$classFiles = array_diff($classList, array('.', '..'));
$objFiles = array_diff($objList, array('.', '..'));

foreach ($objFiles as $singleObj) {
    include $modelString . $singleObj;

}
foreach ($classFiles as $singleClass) {
    $classParts = explode(".", $singleClass);
    if ($classParts[1] === "class") {
        include $classString . $singleClass;
    }
}

use webapp_php_sample_class\ConfigLoader;
use webapp_php_sample_class\JsonHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\PluginLoader;
use webapp_php_sample_class\StartUp;

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
        case DEFAULT_STRING:
            JsonHandler::FireSimpleJson("No content warning", "Your request contains no valid Data");
            break;
        case "pageList":
            StartUp::loadPages("../page/open/", "../config/");
            JsonHandler::FireSimpleJson("done", "valid");
            break;
        case "pluginList":
            PluginLoader::loadPluginConfig();
    }

} catch (Error $e) {
    JsonHandler::FireSimpleJson($e->getCode(), $e->getMessage());
}
<?php

$classList = scandir("../class/");
$objList = scandir("../model/");
$classFiles = array_diff($classList, array('.', '..'));
$objFiles = array_diff($objList, array('.', '..'));

foreach ($objFiles as $singleObj) {
    include "../model/" . $singleObj;

}
foreach ($classFiles as $singleClass) {
    $classParts = explode(".", $singleClass);
    if ($classParts[1] === "class") {
        include "../class/" . $singleClass;
    }
}

use webapp_php_sample_class\ConfigLoader;
use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\PluginLoader;
use webapp_php_sample_class\StartUp;

try {
    ConfigLoader::loadConfig("../config/");
} catch (Error $e) {
    ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
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
            ErrorHandler::FireJsonError("No content warning", "Your request contains no valid Data");
            break;
        case "pageList":
            StartUp::loadPages();
            ErrorHandler::FireJsonError("done", "valid");
            break;
        case "pluginList":
            PluginLoader::loadPluginConfig();
    }

} catch (Error $e) {
    ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
}
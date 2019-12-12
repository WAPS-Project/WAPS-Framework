<?php

use webapp_php_sample_class\ConfigLoader;
use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\PluginLoader;
use webapp_php_sample_class\StartUp;

try {
    ConfigLoader::loadConfig("config/");
} catch (Error $e) {
    ErrorHandler::FireWarning($e->getCode(), $e->getMessage());
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
            ErrorHandler::FireWarning("No content warning", "Your request contains no valid Data");
            break;
        case "pageList":
            StartUp::loadPages();
            break;
        case "pluginList":
            PluginLoader::loadPluginConfig();
    }

} catch (Error $e) {
    ErrorHandler::FireError($e->getCode(), $e->getMessage());
}
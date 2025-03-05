<?php

use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\JsonHandler;
use webapp_php_sample_class\Main;

include 'core/loader/core.loader.php';

$APIString = 'core/API/';

$_ErrorHandler = new ErrorHandler("json");

try {
    // Validiere API-Verzeichnis
    if (!is_dir($APIString) || !is_readable($APIString)) {
        throw new \RuntimeException("API-Verzeichnis nicht gefunden oder nicht lesbar");
    }

    $APIFiles = array_diff(scandir($APIString), array('.', '..'));
    $command = Main::checkRequest('get', 'apiMode');

    $validApiFound = false;

    // Suche nach der passenden API-Datei
    foreach ($APIFiles as $singleAPI) {
        if (!is_file($APIString . $singleAPI) || !is_readable($APIString . $singleAPI)) {
            continue;
        }

        // Validiere Dateinamen und Erweiterung
        $fileParts = explode('.', $singleAPI);
        if (count($fileParts) != 2 || $fileParts[1] !== 'API.php') {
            continue;
        }

        if ($command === $fileParts[0]) {
            include $APIString . $singleAPI;
            $validApiFound = true;
            break;
        }
    }

    if (!$validApiFound) {
        if ($command === null) {
            JsonHandler::FireSimpleJson('No content warning', 'Your request contains no valid Data');
        } else {
            JsonHandler::FireSimpleJson('Invalid API', 'The requested API endpoint does not exist');
        }
    }

} catch (\Throwable $e) {
    ErrorHandler::FireJsonError('API Error', $e->getMessage());
}

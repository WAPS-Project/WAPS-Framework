<?php

use Waps\Framework\Controller\ConfigLoader;
use Waps\Framework\Controller\ErrorHandler;

// Lade Konfiguration
$configString = __DIR__ . '/../../config/';

try {
    ConfigLoader::loadConfig($configString);
} catch (JsonException $e) {
    ErrorHandler::FireError($e->getCode(), $e->getMessage());
}

// Definiere Konstanten aus der Konfiguration
if (!defined('CHARSET')) define('CHARSET', 'utf8');
if (!defined('DESCRIPTION')) define('DESCRIPTION', 'Example Web App');
if (!defined('KEYWORDS')) define('KEYWORDS', 'PHP,HTML,XML,JavaScript,CSS,APP');
if (!defined('AUTHOR')) define('AUTHOR', 'Max Mustermann');
if (!defined('PAGE_TITLE')) define('PAGE_TITLE', 'Web Application PHP');
if (!defined('COPYRIGHT')) define('COPYRIGHT', 'WAPS-Team');
if (!defined('FAV_ICON')) define('FAV_ICON', '/content/img/fav.ico');
if (!defined('LOGO')) define('LOGO', '/content/img/fav.svg');

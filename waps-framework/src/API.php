<?php

use Waps\Framework\Core\ErrorHandler;
use Waps\Framework\Support\JsonHandler;
use Waps\Framework\Core\Application;

require_once __DIR__ . '/../vendor/autoload.php';

try {
	$APIString = __DIR__ . '/core/API/';
	$apiDir = realpath($APIString);
	if ($apiDir === false || !is_dir($apiDir) || !is_readable($apiDir)) {
		throw new \RuntimeException("API-Verzeichnis nicht gefunden oder nicht lesbar");
	}

	$APIFiles = array_diff(scandir($apiDir), array('.', '..'));
	// Trimme den API-Befehl, um unerwünschte Leerzeichen zu entfernen.
	$command = trim(Application::checkRequest('get', 'apiMode'));
	// Frühzeitige Prüfung auf leeren API-Befehl
	if ($command === '') {
		JsonHandler::FireSimpleJson('No content warning', 'Your request contains no valid Data');
		exit;
	}

	$validApiFound = false;

	// Suche nach der passenden API-Datei
	foreach ($APIFiles as $singleAPI) {
		if (!is_file($apiDir . DIRECTORY_SEPARATOR . $singleAPI) || !is_readable($apiDir . DIRECTORY_SEPARATOR . $singleAPI)) {
			continue;
		}
		// Validierung und Extraktion des API-Befehls via Regex (case-insensitive)
		if (preg_match('/^([a-zA-Z0-9_-]+)\.API\.php$/i', $singleAPI, $matches)) {
			if ($command === $matches[1]) {
				require_once $apiDir . DIRECTORY_SEPARATOR . $singleAPI;
				$validApiFound = true;
				break;
			}
		}
	}

	if (!$validApiFound) {
		JsonHandler::FireSimpleJson('Invalid API', 'The requested API endpoint does not exist');
	}

} catch (\Throwable $e) {
	ErrorHandler::FireJsonError('API Error', $e->getMessage());
}

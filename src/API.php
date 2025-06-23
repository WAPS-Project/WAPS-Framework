<?php

use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\JsonHandler;
use webapp_php_sample_class\Main;

include 'core/loader/core.loader.php';

try {
	$APIString = 'core/API/';
	$apiDir = realpath($APIString);
	if ($apiDir === false || !is_dir($apiDir) || !is_readable($apiDir)) {
		throw new \RuntimeException("API-Verzeichnis nicht gefunden oder nicht lesbar");
	}

	$APIFiles = array_diff(scandir($apiDir), array('.', '..'));
	// Trimme den API-Befehl, um unerwünschte Leerzeichen zu entfernen.
	$command = trim(Main::checkRequest('get', 'apiMode'));
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

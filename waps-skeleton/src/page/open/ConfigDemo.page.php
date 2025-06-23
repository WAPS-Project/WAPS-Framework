<?php
// Beispiel: Konfiguration laden
$config = json_decode(file_get_contents(__DIR__ . '/../../config/config.json'), true);
echo '<pre>' . print_r($config, true) . '</pre>';

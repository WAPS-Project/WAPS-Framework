<?php
// Beispiel: Plugin laden und ausführen
if (file_exists(__DIR__ . '/../../plugin/ExamplePlugin/ExamplePlugin.php')) {
    require_once __DIR__ . '/../../plugin/ExamplePlugin/ExamplePlugin.php';
    $plugin = new \Plugin\ExamplePlugin\ExamplePlugin();
    $plugin->run();
} else {
    echo '<p>Plugin nicht gefunden.</p>';
}

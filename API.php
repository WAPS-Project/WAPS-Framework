<?php

use webapp_php_sample_class\JsonHandler;
use webapp_php_sample_class\Main;

include 'core/basic.loader.php';

$APIString = "core/api/";

$APIFiles = array_diff(scandir($APIString), array('.', '..'));
$command = Main::checkGet("apiMode");

foreach ($APIFiles as $singleAPI) {
    $fileParts = explode(".", $singleAPI);
    if ($command === $fileParts[0]) {
        include $APIString . $singleAPI;
    }
    elseif ($command === null) {
        JsonHandler::FireSimpleJson("No content warning", "Your request contains no valid Data");
    }
}
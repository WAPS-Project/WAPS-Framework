<?php

use webapp_php_sample_class\AccountUsage;
use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\SearchEngine;
use webapp_php_sample_class\StartUp;


try {
    StartUp::loadDatabase();
    $pageMap = StartUp::loadPages();
} catch (Exception $e) {
    ErrorHandler::FireError($e->getCode(), $e->getMessage());
}

$pageName = Main::HomeValidation(Main::GetURLInterpreter());
$pagePath = Main::PageValidation($pageName);
$pageList = Main::FileValidation("page/open");
$IP = Main::PostChecker("ip");

try {
    $db_link = new mysqli(
        MYSQL_HOST,
        MYSQL_BENUTZER,
        MYSQL_KENNWORT
    );
} catch (Exception $e) {
    ErrorHandler::FireError($e->getCode(), $e->getMessage());
}

if ($IP != "NO ENTRY") {
    Main::IPush($IP, $db_link);
    echo $IP;
}


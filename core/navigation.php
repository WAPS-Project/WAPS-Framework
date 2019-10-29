<?php

use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\Main;
use webapp_php_sample_class\StartUp;


try {
    StartUp::loadDatabase();
    $pageMap = StartUp::loadPages();
} catch (Exception $e) {
    ErrorHandler::FireError($e->getCode(), $e->getMessage());
}

$pageName = Main::validateHome(Main::getUrlInterpreter());
$pagePath = Main::validatePage($pageName);
$pageList = Main::validateFile("page/open");
$IP = Main::checkPost("ip");

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
    Main::ipPush($IP, $db_link);
    echo $IP;
}


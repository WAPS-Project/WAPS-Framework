<?php

use webapp_php_sample_class\AccountUsage;
use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\SearchEngine;
use webapp_php_sample_class\StartUp;


try {
    StartUp::loadDatabase();
    $pageMap = StartUp::loadPages();
} catch (Exception $e) {
    ErrorHandler::FireError($e->getCode(), $e->getMessage());
}

$_SE = new SearchEngine;
$_USR = new AccountUsage;
$pageName = $_SE::HomeValidation($_SE::GetURLInterpreter());
$pagePath = $_SE::PageValidation($pageName);
$pageList = $_SE::FileValidation("page/open");
$IP = $_SE::PostChecker("ip");

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
    $_SE::IPpush($IP, $db_link);
    echo $IP;
}


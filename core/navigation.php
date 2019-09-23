<?php

$_SE = new SearchEngine;
$_USR = new AccountUsage;
$pageName = $_SE::HomeValidation($_SE::GetURLInterpreter());
$pagePath = $_SE::PageValidation($pageName);
$pageList = $_SE::FileValidation("page/");
$IP = $_SE::PostChecker("ip");
if ($IP != "NO ENTRY") {
    $_SE::IPpush($IP, $db_link);
    echo $IP;
}


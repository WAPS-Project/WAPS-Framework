<?php

use webapp_php_sample_class\SearchEngine;

$lg = "page/private/Lg.page.php";
$rg = "page/private/Pg.page.php";
$lchoice = "page/private/Lchoice.page.php";
$st = SearchEngine::PostChecker("st");


if ($st == "login") {
    include $lg;
} elseif ($st == "register") {
    include $rg;
} else {
    include $lchoice;
}

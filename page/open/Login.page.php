<?php

use webapp_php_sample_class\Main;

$lg = "page/private/Lg.page.php";
$rg = "page/private/Pg.page.php";
$lc = "page/private/Lchoice.page.php";
$st = Main::checkPost("st");


if ($st == "login") {
    include $lg;
} elseif ($st == "register") {
    include $rg;
} else {
    include $lc;
}

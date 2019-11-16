<?php

use webapp_php_sample_class\Main;
use webapp_php_sample_class\SessionTool;
use webapp_php_sample_class\StartUp;

$lg = "page/private/Lg.page.php";
$rg = "page/private/Pg.page.php";
$lc = "page/private/Lchoice.page.php";
$st = Main::checkPost("st");
SessionTool::LoginUser(StartUp::loadDatabase());
SessionTool::AddUser(StartUp::loadDatabase());

if ($st == "login") {
    include $lg;
} elseif ($st == "register") {
    include $rg;
} else {
    include $lc;
}

var_dump($_SESSION['login_User']);
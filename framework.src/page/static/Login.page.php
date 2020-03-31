<?php

/*
PAGEINFO
Title: false;
*/

use webapp_php_sample_class\Main;
use webapp_php_sample_class\SessionTool;
use webapp_php_sample_class\StartUp;

$lg = 'page/private/Lg.page.php';
$rg = 'page/private/Pg.page.php';
$lc = 'page/private/Lchoice.page.php';
$st = Main::checkRequest('post', 'st');
SessionTool::LoginUser(StartUp::loadDatabase());
SessionTool::AddUser(StartUp::loadDatabase());

if ($st === 'login') {
    include $lg;
} elseif ($st === 'register') {
    include $rg;
} else {
    include $lc;
}
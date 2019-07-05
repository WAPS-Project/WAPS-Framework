<?php

$lg = "page/Lg.page.php";
$rg = "page/Pg.page.php";
$lchoice = "page/Lchoice.page.php";
$st = $_SE::PostChecker("st");


if ($st == "login") {
  include $lg;
}

elseif ($st == "register") {
  include $rg;
}

else {
  include $lchoice;
}



?>

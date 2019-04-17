<?php

$lg = "page/Lg.page.php";
$rg = "page/Pg.page.php";
$lchoice = "page/Lchoice.page.php"


$usr = new AccountUsage

if ($_SE -> GetChecker($_GET["st"]) == "login") {
  include $lg;
}

elseif ($_SE -> GetChecker($_GET["st"]) == "register") {
  include $rg;
}

else {
  include $lchoice;
}



?>

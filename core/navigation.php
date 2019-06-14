<?php

  $_SE = new SearchEngine;
  $_USR = new AccountUsage;
  $pagename = $_SE::NameValidation($_SE::HomeValidation($_SE::GetURLInterpreter()));
  $pagepath = $_SE::PageValidation($pagename);
  $pagelist = $_SE::FileValidation("page/");
  $IP = $_SE::PostChecker("ip");
  if ($IP != "NO ENTRY") {
    $_SE::IPpush($IP, $db_link);
    echo $IP;
  }


 ?>

<?php

  $_SE = new SearchEngine;
  $_USR = new AccountUsage;
  $pagename = $_SE -> NameValidation($_SE -> GetChecker('pagename'));
  $pagepath = $_SE -> PageValidation($pagename);
  $pagelist = $_SE -> FileValidation("page/");
  //var_dump($pagelist);

 ?>

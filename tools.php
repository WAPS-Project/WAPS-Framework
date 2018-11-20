<?php

$mainContend = public function getMainContent()
{
  $call = public DOMElement DOMDocument::getElementById ( string $pageName );

  if ($call == 'main') {
    return 'main.php';
  }

  if ($call = 'shop') {
    return 'shop.php';
  }

  else {
    return '404.php';
  }
}

 ?>

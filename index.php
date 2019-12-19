<?php

use webapp_php_sample_class\Main;

?>
<!DOCTYPE html>
<?php
include 'core/UI.loader.php';
?>
<html lang="<?php echo LANGUAGE ?>" dir="ltr">
<?php
include 'page/view/head.php';                                                             // adding the page head
?>
<body>
<?php
include 'page/view/header.php';                                                           //adding the header

Main::main($pagePath, $pageName, $pageMap);

include 'page/view/footer.php';
?>
</body>
</html>
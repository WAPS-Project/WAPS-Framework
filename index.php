<?php

use webapp_php_sample_class\Main;

include 'core/UI.loader.php';

?>
<!DOCTYPE html>
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
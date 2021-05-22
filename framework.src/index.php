<?php

use webapp_php_sample_class\Main;

?>
<!DOCTYPE html>
<?php
include 'core/loader/UI.loader.php';
?>
<html lang="<?php echo LANGUAGE ?>" dir="ltr">
<?php
include 'page/view/head.php';
?>
<body>
<?php
include 'page/view/header.php';

Main::main($pagePath, $pageName, $pageMap);

include 'page/view/footer.php';
?>
</body>
</html>

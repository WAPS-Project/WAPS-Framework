<?php

use webapp_php_sample_class\Main;

require 'config/meta.config.php';

?>
<!DOCTYPE html>
<html lang="<?php echo $language ?>" dir="ltr">
<?php
include 'core/head.php';                                                             // adding the page head
?>
<body>
<?php
include 'core/header.php';                                                           //adding the header

Main::main($pagePath, $pageName);

include 'core/footer.php';
?>
</body>


</html>

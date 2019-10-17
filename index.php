<?php

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
?>
<div class="content">
    <h1 class="titleDoc"><?php echo $pageName ?></h1>
    <?php if ($pagePath != "page/home.page.php") {

        include $pagePath;

    } else {
        include 'page/home.page.php';
    }

    ?>
</div>
<?php
include 'core/footer.php';
?>
</body>


</html>


<!DOCTYPE html>
<html lang="de" dir="ltr">
<?php
include 'core/head.php';                                                             // adding the page head
?>
<body>
<?php
include 'core/header.php';                                                           //adding the header
?>
<div class="content">
    <h1 class="title"><?php echo $pagename ?></h1>
    <?php if ($pagepath != "page/home.page.php") {
            include $pagepath;
          }

          else {
            include 'page/home.page.php';
          }

    ?>
</div>
<?php
include 'core/footer.php';
?>
</body>






</html>

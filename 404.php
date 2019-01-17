<?php
require 'tools.php';
$pagename = "ERROR 404";//##### Hier wird der Seitentitel definiert ######

?>
<!DOCTYPE html>
<html lang="de" dir="ltr">

<?php

include 'head.php';

?>
<body>
<?php

include 'header.php';
?>

<div class="content">

    <h1 class="title"><?php echo $pagename ?></h1>

    <h3>Der von dir gesuchte Inhalt konnte nicht aufgefunden werden</h3>

</div>

<?php
include 'footer.php';
?>
</body>






</html>

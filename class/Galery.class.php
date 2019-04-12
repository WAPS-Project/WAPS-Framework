<?php
/**
 *
 */
class GaleryBuilder
{


  function __construct()
  {
    echo "<script> console.log(' Galery Alive!'); </script>";
  }

  function __destruct() {
    echo "<script> console.log(' Galery done!'); </script>";
  }



  public function GaleryGenerator($path)
  {
    $imgs = scandir($path);
    $count = count($imgs);


    foreach ($imgs as $value) {
      if ($value == ".." or $value == ".") {
        echo "";
      }
      else {
        print("<img src='" . $path . $value ."' class='img_galerie' >");

      }


    }
  }


}



 ?>

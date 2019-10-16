<?php

namespace webapp_php_sample_class;

class GalleryBuilder
{
    function __construct()
    {
        echo "<script> console.log(' Gallery Alive!'); </script>";
    }

    function __destruct()
    {
        echo "<script> console.log(' Gallery done!'); </script>";
    }

    public function GalleryGenerator($path)
    {
        $images = scandir($path);
        $count = count($images);
        foreach ($images as $value) {
            if ($value == ".." or $value == ".") {
                echo "";
            } else {
                print("<img src='" . $path . $value . "' class='img_galleria' >");

            }
        }
    }

}




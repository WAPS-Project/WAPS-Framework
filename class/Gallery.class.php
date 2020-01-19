<?php

namespace webapp_php_sample_class;

class GalleryBuilder
{
    public static function GalleryGenerator($path)
    {
        $images = scandir($path);
        $count = count($images);
        echo "<div class='gallery'>";
        foreach ($images as $value) {
            if ($value == ".." or $value == ".") {
                echo "";
            } else {
                print("<img src='" . $path . $value . "' class='gallery-item' >");

            }
        }
        echo "</div>";
    }

}




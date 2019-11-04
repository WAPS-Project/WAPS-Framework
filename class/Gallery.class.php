<?php

namespace webapp_php_sample_class;

class GalleryBuilder
{
    public static function GalleryGenerator($path)
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




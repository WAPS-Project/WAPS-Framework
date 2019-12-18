<?php

namespace webapp_php_sample_class;

class GalleryBuilder
{
    public static function GalleryGenerator($path)
    {
        $images = array_diff(scandir($path), array(DEFAULT_FILE_FILTER));
        $count = count($images);
        echo "<div class='gallery'>";
        foreach ($images as $value) {
            print("<img src='" . $path . $value . "' class='gallery-item' >");
        }
        echo "</div>";
    }

}




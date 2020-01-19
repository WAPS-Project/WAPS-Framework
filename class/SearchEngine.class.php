<?php

namespace webapp_php_sample_class;

class SearchEngine
{
    public static function SearchQuest($searchGlobal, $link)
    {
        $words = explode(' ', $searchGlobal);
        $wordList = implode(', ', $words);
        $wordCheck = implode(' ', $words);
        $query = 'SELECT * FROM Generator WHERE ' . $wordList . ' LIKE ' . $wordCheck;
        //var_dump($query);
    }


    public static function FormSearch($type, $name, $check, $link)
    {
        if ($check == "on") {
            $query = 'SELECT ' . $name . ' FROM ' . $type;
            if ($result = mysqli_query($link, $query)) {
                /* fetch associative array */
                while ($obj = mysqli_fetch_array($result)) {
                    $array_name = $obj[1];
                    $array_link = $obj[2];
                    $array_img = $obj[3];
                    //var_dump($array_link);
                    //printf("<figure class='product_gallery' > <a href='%s' target='_selfe'><img src=%s class='img_gallery'  alt=""><figcaption>%s</figcaption></a></figure>", $array_link, $array_img, $array_name);
                }
            }
            mysqli_free_result($result);
        }
    }
}

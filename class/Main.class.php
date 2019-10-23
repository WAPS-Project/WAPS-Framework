<?php


namespace webapp_php_sample_class;


class Main
{
    public static function main($pagePath, $pageName)
    {
        echo '<div class="content">';
        echo '<h1 class="titleDoc">' . $pageName . '</h1>';

        if ($pagePath != "page/home.page.php") {

            include $pagePath;

        } else {
            include 'page/home.page.php';
        }

        echo '</div>';

    }

    public static function navigation($pageMap) {

    }

}
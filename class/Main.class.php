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

    public static function navigation($pageMap, $pageName)
    {
        $pageList = json_decode($pageMap);

        echo "<div class='collapse navbar-collapse' id='navbarSupportedContent'>";
        echo "<ul class=\"navbar-nav mr-auto\">";

        foreach ($pageList as $pageObj) {
            $active = "";
            $current = "";


            if ($pageName === $pageObj->Name) {
                echo "<span class='sr-only'>(current)</span>";
            }

            if ($pageName === $pageObj->Name) {
                $active = "active";
            }

            echo "<li class='nav-item'>";

            echo "<a class=\"nav-link " . $active . " \" href='" . $pageObj->path . "' >" . $pageObj->Name . " " . $current . "</a>";
            echo "</li>";
        }
    }

}

//
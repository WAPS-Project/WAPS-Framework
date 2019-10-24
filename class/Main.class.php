<?php


namespace webapp_php_sample_class;

class Main
{
    public static function main($pagePath, $pageName)
    {
        echo '<div class="content">';
        echo '<h1 class="titleDoc">' . $pageName . '</h1>';

        if ($pagePath != "page/open/home.page.php") {

            include $pagePath;

        } else {
            include 'page/open/home.page.php';
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

            echo "<a class=\"nav-link " . $active . " \" href='/" . $pageObj->Name . "' >" . $pageObj->Name . " " . $current . "</a>";
            echo "</li>";
        }
    }

    public static function GetChecker($prf)
    {
        if (isset($_GET[$prf])) {
            return $_GET[$prf];
        } else {
            return "NO ENTRY";
        }
    }

    public static function PostChecker($prf)
    {
        if (!empty($_POST[$prf])) {
            return $_POST[$prf];
        } else {
            return "NO ENTRY";
        }
    }

    public static function PageValidation($pagename)
    {
        if ($pagename == "NO ENTRY") {
            return "page/open/Home.page.php";
        } else {
            return "page/open/" . $pagename . ".page.php";
        }
    }

    public static function HomeValidation($name)
    {
        $pageFiles = scandir("page/open/");
        if ($name == "") {
            return "Home";
        } else {
            foreach ($pageFiles as $file) {
                $f = explode(".", $file);
                if ($name == $f[0]) {
                    return $name;
                }
            }
        }
        return "Error_404";
    }

    public static function NameValidation($pageName)
    {
        if ($pageName == "NO ENTRY") {
            return "Home";
        } else {
            return $pageName;
        }
    }

    public static function FileValidation($path)
    {
        $files = scandir($path);
        $count = count($files);

        $i = 0;
        $fileList = array('page' => array());
        foreach ($files as $file) {
            if ($file == "." || $file == "..") {
                continue;
            } elseif ($file == NULL) {
                ErrorHandler::FireError("FileError", "The File check failed");
            } else {
                $fileList["page"][$i] = $path . $file;
            }
            $i++;
        }
        return $fileList;
    }

    public static function GetURLInterpreter()
    {
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $page = $url[1];
        if (isset($url[2])) {
            return "Error_404";
        } elseif ($page == "") {
            return "Home";
        } else {
            return $page;
        }
    }

    public static function IPush($cip, $link)
    {
        $timestamp = date('H:i:s');
        $date = date('Y-m-d');
        $pip = $_SERVER['REMOTE_ADDR'];
        $info = $_SERVER['HTTP_USER_AGENT'];
        $query = "INSERT INTO iplogg ( info, publicIP, clientIP, TS, DT ) VALUES ( '$info', '$pip', '$cip', '$timestamp', '$date');";
        mysqli_query($link, $query);
    }

}
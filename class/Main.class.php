<?php


namespace webapp_php_sample_class;

use mysqli;

class Main
{
    public static function main($pagePath, $pageName)
    {
        echo '<div class="content">';
        echo '<h1 class="titleDoc">' . $pageName . '</h1>';

        if ($pagePath != "page/open/home.page.php") {

            $pathParts = explode("/", $pagePath);
            $pathParts[1] = "static";
            $staticPath = implode("/", $pathParts);
            $openDir =  scandir("page/open/");
            $staticDir = scandir("page/static/");
            $openProof = 0;
            $staticProof = 0;

            foreach ($openDir as $openFile){
                $open = explode(".", $openFile);
                if ($pageName === $open[0]) {
                    $openProof++;
                }
            }
            foreach ($staticDir as $staticFile){
                $static = explode(".", $staticFile);
                if ($pageName === $static[0]) {
                    $staticProof++;
                }
            }

            if ($openProof > 0) {
                include $pagePath;
            }
            elseif ($staticProof > 0){
                include $staticPath;
            }
        }
        else {
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

    public static function checkGet($key)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        } else {
            return "NO ENTRY";
        }
    }

    public static function checkPost($key)
    {
        if (!empty($_POST[$key])) {
            return $_POST[$key];
        } else {
            return "NO ENTRY";
        }
    }

    public static function validatePage($pageName)
    {
        if ($pageName == "NO ENTRY") {
            return "page/open/Home.page.php";
        }
        else {
            return "page/open/" . $pageName . ".page.php";
        }
    }

    public static function validateHome($name)
    {
        $pageFiles = scandir("page/open/");
        if ($name == "") {
            return "Home";
        }
        elseif ($name === "Impressum") {
            return "Impressum";
        }
        else {
            foreach ($pageFiles as $file) {
                $f = explode(".", $file);
                if ($name == $f[0]) {
                    return $name;
                }
            }
        }
        return "Error_404";
    }

    public static function validateName($pageName)
    {
        if ($pageName == "NO ENTRY") {
            return "Home";
        } else {
            return $pageName;
        }
    }

    public static function validateFile($path)
    {
        $files = scandir($path);

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

    public static function getUrlInterpreter()
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

    public static function ipPush($cip, $link)
    {
        $timestamp = date('H:i:s');
        $date = date('Y-m-d');
        $pip = $_SERVER['REMOTE_ADDR'];
        $info = $_SERVER['HTTP_USER_AGENT'];
        $query = "INSERT INTO iplogg ( info, publicIP, clientIP, TS, DT ) VALUES ( '$info', '$pip', '$cip', '$timestamp', '$date');";
        mysqli_query($link, $query);
    }
}
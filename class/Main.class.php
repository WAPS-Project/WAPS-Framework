<?php


namespace webapp_php_sample_class;

class Main
{
    public static function main($pagePath, $pageName, $pageMap)
    {
        $pageList = json_decode($pageMap);

        echo '<div class="content">';
        foreach ($pageList as $page) {
            if ($page->Name === $pageName && $page->IsSet === true) {
                echo '<h1 class="titleDoc">' . $pageName . '</h1>';
            }
        }

        if ($pagePath != "page/open/home.page.php") {

            $pathParts = explode("/", $pagePath);
            $pathParts[1] = "static";
            $staticPath = implode("/", $pathParts);
            $openDir = scandir("page/open/");
            $staticDir = scandir("page/static/");
            $openProof = 0;
            $staticProof = 0;

            foreach ($openDir as $openFile) {
                $open = explode(".", $openFile);
                if ($pageName === $open[0]) {
                    $openProof++;
                }
            }
            foreach ($staticDir as $staticFile) {
                $static = explode(".", $staticFile);
                if ($pageName === $static[0]) {
                    $staticProof++;
                }
            }

            if ($openProof > 0) {
                include $pagePath;
            } elseif ($staticProof > 0) {
                include $staticPath;
            }
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
        SessionTool::UserWelcome();
    }

    public static function checkGet($key)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        } else {
            return null;
        }
    }

    public static function validatePage($pageName)
    {
        if ($pageName == "NO ENTRY") {
            return "page/open/Home.page.php";
        } else {
            return "page/open/" . $pageName . ".page.php";
        }
    }

    public static function validateHome($name)
    {
        $pageFiles = scandir("page/open/");
        if ($name == "") {
            return "Home";
        } elseif ($name === "Impressum") {
            return "Impressum";
        } elseif ($name === "Login") {
            return "Login";
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

    public static function ipCheck($database_link)
    {
        $clientIp = Main::checkPost("ip");
        self::ipPush($database_link, $clientIp);
    }

    public static function checkPost($key)
    {
        if (!empty($_POST[$key])) {
            return $_POST[$key];
        } else {
            return null;
        }
    }

    public static function getRealIp()
    {
        $ip = 'undefined';
        if (isset($_SERVER)) {
            $ip = $_SERVER['REMOTE_ADDR'];
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            elseif (isset($_SERVER['HTTP_CLIENT_IP'])) $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = getenv('REMOTE_ADDR');
            if (getenv('HTTP_X_FORWARDED_FOR')) $ip = getenv('HTTP_X_FORWARDED_FOR');
            elseif (getenv('HTTP_CLIENT_IP')) $ip = getenv('HTTP_CLIENT_IP');
        }
        $ip = htmlspecialchars($ip, ENT_QUOTES, 'UTF-8');
        return $ip;
    }

    protected static function ipPush($link, $clientIp)
    {
        $timestamp = date('H:i:s');
        $date = date('Y-m-d');
        $pip = self::getRealIp();
        $info = $_SERVER['HTTP_USER_AGENT'];
        $query = "INSERT INTO iplogg ( info, publicIP, clientIP, TS, DT ) VALUES ( '$info', '$pip', '$clientIp', '$timestamp', '$date');";
        mysqli_query($link, $query);
    }
}
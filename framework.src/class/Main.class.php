<?php


namespace webapp_php_sample_class;

class Main
{
    public static function main($pagePath, $pageName, $pageMap): void
    {
        $pageList = json_decode($pageMap, false, 512, JSON_THROW_ON_ERROR);
        echo '<div class="content">';
        foreach ($pageList as $page) {
            if ($page->Name === $pageName && $page->IsSet === true) {
                echo '<h1 class="titleDoc">' . $pageName . '</h1>';
            }
        }

        if ($pagePath !== 'page/open/Home.page.php') {

            $pathParts = explode('/', $pagePath);
            $pathParts[1] = 'static';
            $staticPath = implode('/', $pathParts);
            $openDir = scandir('page/open/');
            $staticDir = scandir('page/static/');
            $openProof = 0;
            $staticProof = 0;

            foreach ($openDir as $openFile) {
                $open = explode('.', $openFile);
                if ($pageName === $open[0]) {
                    $openProof++;
                }
            }
            foreach ($staticDir as $staticFile) {
                $static = explode('.', $staticFile);
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
            include 'page/open/Home.page.php';
        }

        echo '</div>';

    }

    public static function navigation($pageMap, $pageName): void
    {
        $pageList = json_decode($pageMap, false, 512, JSON_THROW_ON_ERROR);
        $pageContainer = [];

        echo "<div class='collapse navbar-collapse' id='navbarSupportedContent'>";
        echo '<ul class="navbar-nav mr-auto">';

        foreach ($pageList as $pageObj) {
            if ($pageObj->Master !== 'null') {
                $pageContainer[] = [$pageObj->Master => $pageObj];
            }
        }

        foreach ($pageList as $pageObj) {
            $active = '';
            $current = '';


            if ($pageName === $pageObj->Name) {
                echo "<span class='sr-only'>(current)</span>";
            }

            if ($pageName === $pageObj->Name) {
                $active = 'active';
            }

            self::createPageEntry($pageObj, $active, $current, $pageContainer);
        }
        SessionTool::UserWelcome();
    }

    private static function createPageEntry($pageObj, $active, $current, $pageContainer): void
    {
        $master = null;
        if (array_key_exists($pageObj->Name, $pageContainer[0])) {
            $master = 'dropdown';
        } else {
            $master = 'simple';
        }

        switch ($master) {
            case 'simple':
                if ($pageContainer[0]['Example']->Name !== $pageObj->Name) {
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link ' . $active . " \" href='/" . $pageObj->Name . "' >" . $pageObj->Name . ' ' . $current . '</a>';
                    echo '</li>';
                }
                break;

            case 'dropdown':
                echo '<div class="dropdown">';
                echo '<div class="btn-group">';
                echo '<a href="/' . $pageObj->Name . '">';
                echo '<button class="btn btn-secondary nav-link button btn-danger" 
                            role="button" 
                            id="dropdownMenuLink' . $pageObj->Name . '" 
                            >' . $pageObj->Name . '</button>';
                echo '</a>';
                echo '<button type="button" class="btn nav-link button btn-danger btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button>';
                echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
                foreach ($pageContainer[0] as $key => $value) {
                    if ($key === $pageObj->Name) {
                        foreach ($value as $item => $tile) {
                            if ($item === 'Name') {
                                echo "<li class='nav-item'>";
                                echo '<a class="dropdown-item nav-link ' . $active . " \" href='/" . $tile . "' >" . $tile . ' ' . $current . '</a>';
                                echo '</li>';
                            }
                        }
                    }
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
                break;
        }
    }

    public static function validatePage($pageName): string
    {
        if ($pageName === 'NO ENTRY') {
            return 'page/open/Home.page.php';
        }

        return 'page/open/' . $pageName . '.page.php';
    }

    public static function validateHome($name): string
    {
        $pageFiles = scandir('page/open/');
        $pageFilesStatic = scandir('page/static/');
        if ($name === '') {
            return 'Home';
        }

        foreach ($pageFiles as $file) {
            $f = explode('.', $file);
            if ($name === $f[0]) {
                return $name;
            }
        }
        foreach ($pageFilesStatic as $file) {
            $f = explode('.', $file);
            if ($name === $f[0]) {
                return $name;
            }
        }
        return 'Error_404';
    }

    public static function validateName($pageName): string
    {
        if ($pageName === 'NO ENTRY') {
            return 'Home';
        }

        return $pageName;
    }

    public static function validateFile($path): array
    {
        $files = array_diff(scandir($path), DEFAULT_FILE_FILTER);

        $i = 0;
        $fileList = array('page' => array());
        foreach ($files as $file) {
            if ($file === NULL) {
                ErrorHandler::FireError('FileError', 'The File check failed');
            } else {
                $fileList['page'][$i] = $path . $file;
            }
            $i++;
        }
        return $fileList;
    }

    public static function getUrlInterpreter()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $page = $url[1];
        if (isset($url[2])) {
            return 'Error_404';
        }

        if ($page === '') {
            return 'Home';
        }

        return $page;
    }

    public static function ipCheck($database_link): void
    {
        $clientIp = self::checkRequest('post', 'ip');
        self::ipPush($database_link, $clientIp);
    }

    public static function checkRequest($mode, $key)
    {
        switch ($mode) {
            case 'post':
                return $_POST[$key] ?? null;

            case 'get':
                return $_GET[$key] ?? null;
        }

        return null;
    }

    protected static function ipPush($link, $clientIp): void
    {
        $timestamp = date('H:i:s');
        $date = date('Y-m-d');
        $pip = self::getRealIp();
        $info = $_SERVER['HTTP_USER_AGENT'];
        $query = "INSERT INTO iplogg ( info, publicIP, clientIP, TS, DT ) VALUES ( '$info', '$pip', '$clientIp', '$timestamp', '$date');";
        $link->query($query);
    }

    public static function getRealIp()
    {
        $ip = 'undefined';
        if (isset($_SERVER)) {
            $ip = $_SERVER['REMOTE_ADDR'];
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        } else {
            $ip = getenv('REMOTE_ADDR');
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $ip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP')) {
                $ip = getenv('HTTP_CLIENT_IP');
            }
        }
        $ip = htmlspecialchars($ip, ENT_QUOTES, 'UTF-8');
        return $ip;
    }
}
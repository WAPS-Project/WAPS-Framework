<?php

namespace webapp_php_sample_class;

class SearchEngine
{

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

    public static function FileTypeChecker($path, $type)
    {
        $files = scandir($path);
        foreach ($files as $file) {
            if ($file == "." || $file == "..") {
                continue;
            } elseif ($file == NULL) {
                die("Es ist ein Fehler aufgetreten!");
            } else {
                $fArray = explode(".", $file);
                $keyName = $fArray[0];
                $keyType = $fArray[1];
                try {
                    $fileType = $fArray[2];
                } catch (\Exception $e) {
                }
                if ($keyType != "php" || $keyType != "js") {
                    if ($keyType == "class" && $fileType == "php") {
                        echo "</br>Data: Name = $keyName , Type = $keyType";
                    } elseif ($keyType == "page" && $fileType == "php") {
                        echo "</br>Data: Name = $keyName , Type = $keyType";
                    } elseif ($keyType == "config" && $fileType == "php") {
                        echo "</br>Data: Name = $keyName , Type = $keyType";
                    } else {
                        throw new Exception("ERROR J1: $file is not a valid Page, Config or Class file, please check your input!");
                    }
                } else {
                    throw new Exception("ERROR J0: $file is not a valid file, please check your input!");
                }
            }

        }
        return;
    }

    public static function ListChecker($path, $sure)
    {
        $files = scandir($path);
        foreach ($files as $file) {
            $mash = explode(".", $file);
            $name = $mash[0];
            if ($name == $sure) {
                return $sure;
                break;
            } else {
                continue;
            }
        }
        throw new Exception("Error Processing Request", 404);
    }

    public static function PageValidation($pagename)
    {
        if ($pagename == "NO ENTRY") {
            return "page/Home.page.php";
        } else {
            return "page/" . $pagename . ".page.php";
        }
    }

    public static function HomeValidation($name)
    {
        $pageFiles = scandir("page/");
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
        //var_dump($count);
        $i = 0;
        $fileList = array('page' => array());
        foreach ($files as $file) {
            if ($file == "." || $file == "..") {
                continue;
            } elseif ($file == NULL) {
                die("Es ist ein Fehler aufgetreten!");
            } else {
                $fileList["page"][$i] = $path . $file;
            }
            $i++;
        }
        return $fileList;
    }


    public static function SearchQuest($searchGlobal, $link)
    {
        $words = explode(" ", $searchGlobal);
        $wordList = implode(", ", $words);
        $wordCheck = implode(" ", $words);
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
                    printf("<figure class='product_gallery' > <a href='%s' target='_selfe'><img src=%s class='img_gallery' ><figcaption>%s</figcaption></a></figure>", $array_link, $array_img, $array_name);
                }
            }
            mysqli_free_result($result);
        }
    }


    public static function IPpush($cip, $link)
    {
        $timestamp = date('H:i:s');
        $date = date('Y-m-d');
        $pip = $_SERVER['REMOTE_ADDR'];
        $info = $_SERVER['HTTP_USER_AGENT'];
        $query = "INSERT INTO iplogg ( info, publicIP, clientIP, TS, DT ) VALUES ( '$info', '$pip', '$cip', '$timestamp', '$date');";
        $injc = mysqli_query($link, $query);
    }


    public static function GetURLInterpreter()
    {
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("/", $url);
        $page = $url[1];
        if (isset($url[2])) {
            $pagesub = $url[2];
            return "Error_404";
        } elseif ($page == "") {
            return "Home";
        } else {
            return $page;
        }
    }
}

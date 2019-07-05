<?php
  /**
   *
   */
  class SearchEngine
  {


    public static function GetChecker($prf)
    {


      if (isset($_GET[$prf])) {
        return $_GET[$prf];
      }

      else {
        return "NO ENTRY";
      };
    }

    public static function PostChecker($prf)
    {


      if (!empty($_POST[$prf])) {
        return $_POST[$prf];
      }

      else {
        return "NO ENTRY";
      };
    }

    public static function FileTypeChecker($path)
    {
      $files = scandir($path);

      foreach ($files as $file) {
        if ($file == "." || $file == "..") {
          continue;
        }
        elseif ($file == NULL) {
          die("Es ist ein Fehler aufgetreten!");
        }
        else {
          $farray = explode(".", $file);
            $keyname = $farray[0];
            $keytype = $farray[1];


            try {
              $filetype = $farray[2];
            } catch (\Exception $e) {
            }

            if ($keytype != "php" || $keytype != "js") {
              if ($keytype == "class" && $filetype == "php") {
                echo "</br>Data: Name = $keyname , Type = $keytype";
              }

              elseif ($keytype == "page" && $filetype == "php") {
                echo "</br>Data: Name = $keyname , Type = $keytype";
              }

              elseif ($keytype == "config" && $filetype == "php") {
                echo "</br>Data: Name = $keyname , Type = $keytype";
              }

              else {
                throw new Exception("ERROR J1: $file is not a valid Page, Config or Class file, please check your input!");
              }
            }
            else {
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
        }

        else {
          continue;
        }

      }

      throw new Exception("Error Processing Request", 404);
      
    }

    public static function PageValidation($pagename)
    {
      if ($pagename == "NO ENTRY") {
        return "page/Home.page.php";
      }
      else {
        return "page/" . $pagename . ".page.php";
      }
    }

    public static function HomeValidation($name)
    {

      $pagefiles = scandir("page/");

      if ($name == "") {
        return "Home";
      }

      else {
        foreach ($pagefiles as $file) {
          $f = explode(".", $file);
          if ($name == $f[0]) {
            return $name;
          }
        }
      }
      return "Error_404";

    }

    public static function NameValidation($pagename)
    {
      if ($pagename == "NO ENTRY") {
        return "Home";
      }
      else {
        return $pagename;
      }
    }

    public static function FileValidation($path)
    {
      $files = scandir($path);
      $count = count($files);
      //var_dump($count);

        $i = 0;

        $filelist = array('page' => array());
        foreach ($files as $file) {
          if ($file == "." || $file == "..") {
            continue;
          }
          elseif ($file == NULL) {
            die("Es ist ein Fehler aufgetreten!");
          }
          else {
            $filelist["page"][$i] = $path . $file;
          }
          $i++;
        }

      return $filelist;

    }



    public static function SearchQuest($searchglobal, $link)
    {
      $words = explode(" ", $searchglobal);
      $wordlist = implode(", ", $words);
      $wordcheck = implode(" ", $words);
      $query = 'SELECT * FROM Generator WHERE ' .  $wordlist . ' LIKE ' . $wordcheck;

      //var_dump($query);



    }


    public static function FormSearch($type, $name, $check, $link)
    {


      if ($check == "on") {
        $query = 'SELECT ' . $name . ' FROM ' . $type ;

        if ($result = mysqli_query($link, $query)) {

          /* fetch associative array */
          while ($obj = mysqli_fetch_array($result)) {
            $array_name = $obj[1];
            $array_link = $obj[2];
            $array_img = $obj[3];
            //var_dump($array_link);
            printf ("<figure class='product_galerie' > <a href='%s' target='_selfe'><img src=%s class='img_galerie' ><figcaption>%s</figcaption></a></figure>", $array_link, $array_img, $array_name);
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

      if ($page == "") {
        return "Home";
      }

      else {
        return $page;
      }


      
    }




  }



 ?>

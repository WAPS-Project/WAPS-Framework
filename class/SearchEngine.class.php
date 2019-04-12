<?php
  /**
   *
   */
  class SearchEngine
  {


    public function GetChecker($prf)
    {


      if (isset($_GET[$prf])) {
        return $_GET[$prf];
      }

      else {
        return "NO ENTRY";
      };
    }

    public function PostChecker($prf)
    {


      if (!empty($_POST[$prf])) {
        return $_POST[$prf];
      }

      else {
        return "NO ENTRY";
      };
    }

    public function PageValidation($pagepath)
    {
      if ($pagepath == "NO ENTRY") {
        return "page/home.page.php";
      }
      else {
        return "page/" . $pagepath . ".page.php";
      }
    }

    public function NameValidation($pagename)
    {
      if ($pagename == "NO ENTRY") {
        return "home";
      }
    }

    public function FileValidation($path)
    {
      $files = scandir($path);
      //var_dump($files);

      foreach ($files as $file) {
        if ($file == "." || $file == "..") {
          echon "Pann ";
        }
        
      }


			//$filelist = array('class' => array(), 'page' => array(), 'file' => array());
			/*foreach ($files as $file){
        if ($file == "." || $file == "..") {
          return;
        }
        else {
          $f = explode($file, ".");
					$filename = $f[0];

					if ($f[1] == "php"){
						$filetype = "php";
						return $filelist['file'][$filename . "." . $filetype];
						}
					elseif ($f[1] == "js"){
					 $filetype = "js";
						return $filelist['file'][$filename . "." . $filetype];
					}
					elseif ($f[1] == "css"){
						$filetype = "css";
						return $filelist['file'][$filename . "." . $filetype];
						}
					elseif ($f[1] == "jpg"){
						$filetype = "jpg";
						return $filelist['file'][$filename . "." . $filetype];
						}
					elseif ($f[1] == "png"){
						$filetype = "png";
						return $filelist['file'][$filename . "." . $filetype];
						}
					elseif ($f[1] == "svg"){
						$filetype = "svg";
						return $filelist['file'][$filename . "." . $filetype];
						}
					elseif ($f[1] == "obj"){
						$filetype = "obj";
						return $filelist['file'][$filename . "." . $filetype];
						}
					elseif ($f[1] == "gif"){
						$filetype = "gif";
						return $filelist['file'][$filename . "." . $filetype];
						}
					elseif ($f[1] == "json"){
						$filetype = "json";
						return $filelist['file'][$filename . "." . $filetype];
						}
					elseif ($f[1] == "class"){
						if ($f[2] == "php" ){
							$filetype = "class.php";
							return $filelist['class'][$filename . "." . $filetype];
							}
						elseif ($f[2] == "js"){
						$filetype = "class.js";
						return $filelist['class'][$filename . "." . $filetype];
						}
            return $filelist;
						}
					elseif ($f[1] == "page"){
						if ($f[2] == "php"){
							$filetype = "page.php";
							return $filelist['page'][$filename . "." . $filetype];
							}
						}
        }
			}*/

    }



    public function SearchQuest($searchglobal, $link)
    {
      $words = explode(" ", $searchglobal);
      $wordlist = implode(", ", $words);
      $wordcheck = implode(" ", $words);
      $query = 'SELECT * FROM Generator WHERE ' .  $wordlist . ' LIKE ' . $wordcheck;

      //var_dump($query);



    }


    public function FormSearch($type, $name, $check, $link)
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

          /* free result set */
          mysqli_free_result($result);

        }
        mysqli_close($link);
      }


    }


  }



 ?>

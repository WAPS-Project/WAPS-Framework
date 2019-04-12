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

    public function FileVerification($path)
    {
      $files = scandir($path);
			$filelist = array('class' => array(), 'page' => array(), 'file' => array());
			foreach ($files as $file){
					$f = explode($file, ".");
					$filename = $f[0];
					if ($f[1] == "php"){
						return $filetype = "php";
						}
					elseif ($f[1] == "js"){
					 return $filetype = "js";
					}
					elseif ($f[1] == "css"){
						return $filetype = "css";
						}
					elseif ($f[1] == "jpg"){
						return $filetype = "jpg";
						}
					elseif ($f[1] == "png"){
						return $filetype = "png";
						}
					elseif ($f[1] == "svg"){
						return $filetype = "svg";
						}
					elseif ($f[1] == "obj"){
						return $filetype = "obj";
						}
					elseif ($f[1] == "gif"){
						return $filetype = "gif";
						}
					elseif ($f[1] == "json"){
						return $filetype = "json";
						}
					elseif ($f[1] == "class"){
						if ($f[2] == "php" ){
							return $filetype = "class.php";
							}
						elseif ($f[2] == "js"){
						return $filetype = "class.js";
						}
						else {
							return "ERROR No valid class";
						}
						}
					elseif ($f[1] == "page"){
						if ($f[2] == "php"){
							return $filetype = "page.php";
							}
						else {
							return "ERROR No valid Page";
						}
						}
					else {
						return "ERROR Not a valid File";
					}
					
					return $filelist;
					
					
			}
      
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

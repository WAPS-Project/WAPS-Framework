<?php
/**
 *
 */
class AccountUsage
{


  public function LoginUser($db)
  {
    if($_SERVER["REQUEST_METHOD"] == "POST") {
          // Benutzername und Passwort vom Formular gesendet

          $myUsername = mysqli_real_escape_string($db,$_POST['username']);
          $mypassword = mysqli_real_escape_string($db,$_POST['password']);

          $sql = "SELECT UID.user FROM user, password WHERE username = '$myUsername' and password = '$mypassword' LEFT JOIN password ON UID.user = UID.password";
          $result = mysqli_query($db, $sql);
          $row = mysqli_fetch_array($result);
          $active = $row['active'];

          $count = mysqli_num_rows($result);

          // Wenn das Ergebnis mit $myUsername und $mypassword übereinstimmt,
          // muss die Tabellenzeile 1 sein

          if($count == 1) {
             session_register("myUsername");
             $_SESSION['login_User'] = $myUsername;

             header("location: core/welcome.php");
          }else {
             $error = "Your Login Name or Password is invalid";
          }
       }
  }


  public function AddUser($db_link) {

    $__SE = new SearchEngine;

    $username = $__SE -> PostChecker("username");
    $firstname = $__SE -> PostChecker("firstName");
    $seccondname = $__SE -> PostChecker("lastName");
    $age = $__SE -> PostChecker("age");
    $password = $__SE -> PostChecker("pw");
    $check = $__SE -> PostChecker("check");



    if ($check == "on") {

      if ($age >= 18) {
        $ageID = 5;
      }

      elseif ($age >= 16 && $age < 18) {
        $ageID = 4;
      }

      elseif ($age >= 12 && $age < 16) {
        $ageID = 3;
      }

      elseif ($age >= 6 && $age < 12) {
        $ageID = 2;
      }

      elseif ($age >= 0 && $age < 6) {
        $ageID = 1;
      }


      $queryUSID = "SELECT UID AS 'ID' FROM user ORDER BY 'ID' DESC LIMIT 1;";


      if ($rslt = mysqli_query($db_link, $queryUSID)) {

        var_dump($rslt);

        while ($obj = mysqli_fetch_array($rslt)) {
          var_dump($obj);
          $USID = $obj[0] + 1;


          $query ="INSERT INTO user ( username, firstname, lastname, userrank, AID ) VALUES (  '$username' , '$firstname', '$seccondname', 'User', $ageID );";
          var_dump($query);
          $query2= "INSERT INTO password ( password, UID) VALUES ( '$password', $USID);";
          var_dump($query2);
          //$uname = mysqli_query($db_link, $query);
          //$upw = mysqli_query($db_link, $query2);



          }




      }

      mysqli_free_result($rslt);

    }


  }



}



 ?>

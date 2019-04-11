<?php
/**
 *
 */
class AccountUsage extends SearchEngine
{


  public function LoginUser()
  {
    if($_SERVER["REQUEST_METHOD"] == "POST") {
          // Benutzername und Passwort vom Formular gesendet

          $myUsername = mysqli_real_escape_string($db,$_POST['Username']);
          $mypassword = mysqli_real_escape_string($db,$_POST['password']);

          $sql = "SELECT UID FROM User WHERE Username = '$myUsername' and passcode = '$mypassword'";
          $result = mysqli_query($db_link, $sql);
          $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
          $active = $row['active'];

          $count = mysqli_num_rows($result);

          // Wenn das Ergebnis mit $myUsername und $mypassword übereinstimmt,
          // muss die Tabellenzeile 1 sein

          if($count == 1) {
             session_register("myUsername");
             $_SESSION['login_User'] = $myUsername;

             header("location: welcome.php");
          }else {
             $error = "Your Login Name or Password is invalid";
          }
       }
  }


  public function AddUser($link, $Username, $firstname, $seccondname, $age, $password, $check)
  {

    $queryUSID = "SELECT MAX(USID) from Users;";

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

      if ($result = mysqli_query($link, $queryUSID)) {
        while ($obj = mysqli_fetch_array($result)) {

          $USID = $obj[0] + 1;
          //var_dump($USID);

          $query ="INSERT INTO Users ( Username, Firstname, Lastname, GENID, AID ) VALUES ( '" . $Username . "', '" . $firstname . "', '" . $seccondname . "', 1, " . $ageID . ");";

          $query2= "INSERT INTO passw ( PSSWD, USID) VALUES ( '" . $password . "', " . $USID . ");";

          $uname = mysqli_query($link, $query);
          $upw = mysqli_query($link, $query2);

        }




      }



    }


  }



}



 ?>

<?php
/**
 *
 */
class AccountUsage extends SearchEngine
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


  public function AddUser($link, $username, $firstname, $seccondname, $age, $password, $check)
  {

    $queryUSID = "SELECT MAX(UID) AS 'ID' FROM user";
    //var_dump($queryUSID);

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
        if ($obj = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          var_dump($obj);
          $USID = $obj['ID'];

          $query ="INSERT INTO user ( username, firstname, lastname, userrank, AID ) VALUES (  '$username' , '$firstname', '$seccondname', 'User', $ageID );";
          var_dump($query);
          $query2= "INSERT INTO password ( password, UID) VALUES ( '$password', $USID);";
          var_dump($query2);
          //$uname = mysqli_query($link, $query);
          //$upw = mysqli_query($link, $query2);


          }



      }



    }


  }



}



 ?>

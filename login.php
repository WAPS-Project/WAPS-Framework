<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
      // Benutzername und Passwort vom Formular gesendet

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT UID FROM user WHERE username = '$myusername' and passcode = '$mypassword'";
      $result = mysqli_query($db_link, $sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];

      $count = mysqli_num_rows($result);

      // Wenn das Ergebnis mit $myusername und $mypassword übereinstimmt,
      // muss die Tabellenzeile 1 sein

      if($count == 1) {
         session_register("myusername");
         $_SESSION['login_user'] = $myusername;

         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
 ?>

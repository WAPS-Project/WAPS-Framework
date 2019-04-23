<?php
/**
 *
 */
class AccountUsage
{


  public function LoginUser($db)
  {

    $__SE = new SearchEngine;

    $myUsername = $__SE -> PostChecker("username");
    $mypassword = $__SE -> PostChecker("password");

    $queryCheck = "SELECT username, passwort FROM usr LEFT JOIN passwd ON usr.UID = passwd.UID WHERE username = '$myUsername';";


    if ($result = mysqli_query($db, $queryCheck)) {

      while ($rarray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        $trust = password_verify($mypassword, $rarray["passwort"]);

        if($trust == true) {
           session_start();
           $_SESSION['login_User'] = $myUsername;
           echo "Welcome";
        }

        else {
           $error = "Your Login Name or Password is invalid";
        }


      }
    }



    /*if($count == 1) {
       session_register("myUsername");
       $_SESSION['login_User'] = $myUsername;

       header("location: core/welcome.php");
    }

    else {
       $error = "Your Login Name or Password is invalid";
    }
    */


  }


  public function AddUser($db_link) {

    $__SE = new SearchEngine;

    $username = $__SE -> PostChecker("username");
    $firstname = $__SE -> PostChecker("firstName");
    $seccondname = $__SE -> PostChecker("lastName");
    $email = $__SE -> PostChecker("email");
    $age = $__SE -> PostChecker("age");
    $password = $__SE -> PostChecker("pw");
    $check = $__SE -> PostChecker("check");
    $pwsave =  password_hash($password, PASSWORD_DEFAULT);

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


      //$queryUSID = "SELECT `UID` AS 'ID' FROM `usr` ORDER BY 'ID' DESC LIMIT 1;";
      $queryUSID = "SELECT MAX(UID) AS 'ID' FROM usr;";

      //var_dump($queryUSID);

      if ($rslt = mysqli_query($db_link, $queryUSID)) {

        //var_dump($rslt);

        while ($obj = mysqli_fetch_array($rslt)) {
          //var_dump($obj);
          $USID = $obj["ID"] + 1;


          $query ="INSERT INTO usr ( username, firstname, lastname, email, userrank, AID ) VALUES (  '$username' , '$firstname', '$seccondname', '$email', 'User', $ageID );";
          //var_dump($query);
          $query2= "INSERT INTO passwd ( passwort, UID) VALUES ( '$pwsave', $USID);";
          //var_dump($query2);
          $uname = mysqli_query($db_link, $query);
          $upw = mysqli_query($db_link, $query2);



          }




      }


    }


  }



}



 ?>

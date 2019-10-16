<?php

namespace webapp_php_sample_class;

class AccountUsage
{

    public static function LoginUser($db)
    {
        $__SE = new SearchEngine;
        $myUsername = $__SE::PostChecker("username");
        $myPassword = $__SE::PostChecker("password");
        $queryCheck = "SELECT username, passwort FROM usr LEFT JOIN passwd ON usr.UID = passwd.UID WHERE username = '$myUsername';";
        if ($result = mysqli_query($db, $queryCheck)) {
            while ($rArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $trust = password_verify($myPassword, $rArray["password"]);
                if ($trust == true) {
                    session_start();
                    $_SESSION['login_User'] = $myUsername;
                    echo("<script> alert('Läuft')</script>");
                } else {
                    $error = "Your Login Name or Password is invalid";
                    echo $error;
                }
            }
        }
    }

    public static function UserWelcome()
    {
        $__SE = new SearchEngine;
        if (isset($_SESSION['login_User'])) {
            $username = $_SESSION['login_User'];
            echo "<form method= \"post\"  id= \"userLogin\">";
            echo "<label id= \"greetings\">Herzlich Willkommen $username</label>";
            echo "<button id= \"logout\" type=\"submit\" class=\"btn btn-secondary button logging-btn\" name= \"logout\" value= \"TRUE\">Logout</button>";
            echo "</form>";
        } else {
            echo "<button class=\"btn btn-secondary button logging-btn\"><a href=\"/Login\" >Login/Registration</a></button>";
        }
        $logoutCheck = $__SE::PostChecker("logout");
        if ($logoutCheck == "TRUE") {
            session_destroy();
            echo "Logout erfolgreich";
        }
    }

    public static function AddUser($db_link)
    {
        $__SE = new SearchEngine;
        $username = $__SE::PostChecker("username");
        $firstName = $__SE::PostChecker("firstName");
        $secondName = $__SE::PostChecker("lastName");
        $email = $__SE::PostChecker("email");
        $age = $__SE::PostChecker("age");
        $password = $__SE::PostChecker("pw");
        $check = $__SE::PostChecker("check");
        $pwSave = password_hash($password, PASSWORD_DEFAULT);
        if ($check == "on") {
            if ($age >= 18) {
                $ageID = 5;
            } elseif ($age >= 16 && $age < 18) {
                $ageID = 4;
            } elseif ($age >= 12 && $age < 16) {
                $ageID = 3;
            } elseif ($age >= 6 && $age < 12) {
                $ageID = 2;
            } elseif ($age >= 0 && $age < 6) {
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
                    $query = "INSERT INTO usr ( username, firstname, lastname, email, userrank, AID ) VALUES (  '$username' , '$firstName', '$secondName', '$email', 'User', $ageID );";
                    //var_dump($query);
                    $query2 = "INSERT INTO passwd ( passwort, UID) VALUES ( '$pwSave', $USID);";
                    //var_dump($query2);
                    mysqli_query($db_link, $query);
                    mysqli_query($db_link, $query2);
                }
            }
        }
    }
}

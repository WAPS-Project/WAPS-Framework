<?php

namespace webapp_php_sample_class;

class SessionTool
{

    public static function LoginUser($db)
    {
        $myUsername = Main::checkPost("username");
        $myPassword = Main::checkPost("password");
        $queryCheck = "SELECT username, passwort FROM usr LEFT JOIN passwd ON usr.UID = passwd.UID WHERE username = '" . filter_var($myUsername, FILTER_SANITIZE_STRING) . "';";
        if ($result = mysqli_query($db, $queryCheck, MYSQLI_USE_RESULT)) {
            while ($rArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $trust = password_verify($myPassword, $rArray["passwort"]);
                if ($trust == true) {
                    $_SESSION['login_User'] = $myUsername;
                    header( "Location: Home" );
                    exit;
                } else {
                    $error = "Your Login Name or Password is invalid";
                    ErrorHandler::FireWarning("Login failed", $error);
                }
            }
        }
        mysqli_close($db);
    }

    public static function UserWelcome()
    {
        if (isset($_SESSION['login_User'])) {
            $username = $_SESSION['login_User'];
            echo "<form method= \"post\"  id= \"userLogin\">";
            echo "<label id= \"greetings\" class='greeting'>Herzlich Willkommen $username </label>" . "   ";
            echo "<button id= \"logout\" type=\"submit\" class=\"btn btn-danger button logging-btn\" name= \"logout\" value= \"TRUE\">Logout</button>";
            echo "</form>";
        } else {
            echo "<a href=\"/Login\" class='logging-btn-a'><button class=\"logging-btn\">Login/Registration</button></a>";
        }
        $logoutCheck = Main::checkPost("logout");
        if ($logoutCheck == "TRUE") {
            session_destroy();
            header( "Location: Home" );
            exit;
        }
    }

    public static function AddUser($db_link)
    {
        $username = filter_var(Main::checkPost("username"), FILTER_SANITIZE_STRING);
        $firstName = filter_var(Main::checkPost("firstName"), FILTER_SANITIZE_STRING);
        $secondName = filter_var(Main::checkPost("lastName"), FILTER_SANITIZE_STRING);
        $email = filter_var(Main::checkPost("email"), FILTER_SANITIZE_EMAIL);
        $age = filter_var(Main::checkPost("age"), FILTER_SANITIZE_NUMBER_INT);
        $password = filter_var(Main::checkPost("pw"), FILTER_SANITIZE_STRING);
        $check = Main::checkPost("check");
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

            $queryUSID = "SELECT MAX(UID) AS 'ID' FROM usr;";

            if ($result = mysqli_query($db_link, $queryUSID)) {

                while ($obj = mysqli_fetch_array($result)) {

                    $USID = $obj["ID"] + 1;
                    $query = "INSERT INTO usr ( username, firstname, lastname, email, userrank, AID ) VALUES (  '$username' , '$firstName', '$secondName', '$email', 'User', $ageID );";

                    $query2 = "INSERT INTO passwd ( passwort, UID) VALUES ( '$pwSave', $USID);";

                    mysqli_query($db_link, $query);
                    mysqli_query($db_link, $query2);
                }
            }
        }
        mysqli_close($db_link);
    }
}

<?php

namespace webapp_php_sample_class;

class SessionTool
{

    public static function LoginUser($db)
    {
        $myUsername = Main::checkRequest('post', 'username');
        $myPassword = Main::checkRequest('post', 'password');
        $queryCheck = "SELECT userName, usr.UID, passwort FROM usr LEFT JOIN passWd ON usr.UID = passWd.UID WHERE userName = '" . filter_var($myUsername, FILTER_SANITIZE_STRING) . "';";
        if ($result = $db->query($queryCheck, MYSQLI_USE_RESULT)) {
            while ($rArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $trust = password_verify($myPassword, $rArray['passwort']);
                if ($trust === true) {
                    $_SESSION['login_User'] = $myUsername;
                    $_SESSION['UID'] = $rArray['UID'];
                    header('Location: Home');
                    exit;
                }

                $error = 'Your Login Name or Password is invalid';
                ErrorHandler::FireWarning('Login failed', $error);
            }
        }
        mysqli_close($db);
    }

    public static function UserWelcome()
    {
        if (isset($_SESSION['login_User'])) {
            $username = $_SESSION['login_User'];
            echo '<form method= "post"  id= "userLogin">';
            echo '<div class="dropdown">';
            echo '<button class="btn btn-secondary dropdown-toggle nav-link button btn-danger" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Nutzermenü</button>';
            echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
            echo "<label id= \"greetings\" class='greeting dropdown-item'>Herzlich Willkommen, $username </label>" . '   ';
            echo '<div class="dropdown-divider"></div>';
            echo '<li class="nav-item"><a class="dropdown-item" href="/Config"> Einstellungen</a></li>';
            echo '<button id= "logout" type="submit" class="btn btn-danger button logging-btn dropdown-item" name= "logout" value= "TRUE">Logout</button>';
            echo '</div>';
            echo '</div>';
            echo '</form>';
        } else {
            echo "<a href=\"/Login\" class='logging-btn-a nav-link'><button class=\"logging-btn\">Login/Registration</button></a>";
        }
        $logoutCheck = Main::checkRequest('post', 'logout');
        if ($logoutCheck === 'TRUE') {
            session_destroy();
            header('Location: Home');
            exit;
        }
    }

    public static function AddUser($db_link)
    {
        $username = filter_var(Main::checkRequest('post', 'username'), FILTER_SANITIZE_STRING);
        $firstName = filter_var(Main::checkRequest('post', 'firstName'), FILTER_SANITIZE_STRING);
        $secondName = filter_var(Main::checkRequest('post', 'lastName'), FILTER_SANITIZE_STRING);
        $email = filter_var(Main::checkRequest('post', 'email'), FILTER_SANITIZE_EMAIL);
        $age = filter_var(Main::checkRequest('post', 'age'), FILTER_SANITIZE_NUMBER_INT);
        $password = filter_var(Main::checkRequest('post', 'pw'), FILTER_SANITIZE_STRING);
        $check = Main::checkRequest('post', 'check');
        $pwSave = password_hash($password, PASSWORD_DEFAULT);
        if ($check === "on") {
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

                    $USID = $obj['ID'] + 1;
                    $query = "INSERT INTO usr ( userName, firstName, lastName, email, userRank, AID ) VALUES (  '$username' , '$firstName', '$secondName', '$email', 'User', $ageID );";

                    $query2 = "INSERT INTO passWd ( passwort, UID) VALUES ( '$pwSave', $USID);";

                    $db_link->query($query);
                    $db_link->query($query2);
                }
            }
        }
        mysqli_close($db_link);
    }
}

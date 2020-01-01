<?php


namespace webapp_php_sample_class;


class UserConfig
{
    public static function loadConfigTable()
    {
        self::tableGenerator();
    }

    private static function tableGenerator()
    {
        $userData = self::getUserData($_SESSION["login_User"]);

        echo "<form class='form-session' method='post' target='_self'>";

        foreach ($userData as $item) {
            foreach ($item as $key => $value) {
                self::tableModule($key, $value);
            }
        }
        echo "<button type='submit' class='btn btn-success'>Speichern</button>";
        echo " | ";
        echo "<button type='reset' class='btn btn-danger'>Reset</button>";
        echo "</form>";
    }

    private static function getUserData($userName)
    {
        $userDataArray = [];
        $userData = DatabaseHandler::createSqlRequest(
            "select",
            "usr",
            "*",
            null,
            " usr.userName = '" . $userName . "'");
        $userPassword = DatabaseHandler::createSqlRequest(
            "select",
            "passWd",
            "*",
            null,
            "UID = '" . $userData[0]["UID"] . "'");

        foreach ($userData as $item) {
            foreach ($item as $key => $val) {
                if ($key === "userName"
                    || $key === "firstName"
                    || $key === "lastName"
                    || $key === "email") {
                    array_push($userDataArray, [$key => $val]);
                }
            }
        }

        foreach ($userPassword as $item) {
            foreach ($item as $key => $val) {
                if ($key === "passwort") {
                    array_push($userDataArray, [$key => $val]);
                }
            }
        }
        return $userDataArray;
    }

    private static function tableModule($key, $value)
    {

        switch ($key) {
            case "userName":
                echo "<div class=\"form-group\">";
                echo "<label class=\"label\" for=\"Input" . $key . "\"><i class=\"fas fa-user-tie\"></i> Username </label>";
                echo "<input aria-describedby=\"" . $key . "Input\" class=\"form-control input\" id=\"" . $key . "Input\" 
               name=\"" . $key . "\"
               placeholder=\"Enter " . $key . "\"
               value=\"" . $value . "\"
               required type=\"text\">";
                echo "</div>";
                break;

            case "firstName":
                echo "<div class=\"form-group\">";
                echo "<label class=\"label\" for=\"Input" . $key . "\">Vorname</label>";
                echo "<input aria-describedby=\"" . $key . "Input\" class=\"form-control input\" id=\"" . $key . "Input\" 
               name=\"" . $key . "\"
               placeholder=\"Enter " . $key . "\"
               value=\"" . $value . "\"
               required type=\"text\">";
                echo "</div>";
                break;

            case "lastName":
                echo "<div class=\"form-group\">";
                echo "<label class=\"label\" for=\"Input" . $key . "\">Nachname</label>";
                echo "<input aria-describedby=\"" . $key . "Input\" class=\"form-control input\" id=\"" . $key . "Input\" 
               name=\"" . $key . "\"
               placeholder=\"Enter " . $key . "\"
               value=\"" . $value . "\"
               required type=\"text\">";
                echo "</div>";
                break;

            case "email":
                echo "<div class=\"form-group\">";
                echo "<label class=\"label\" for=\"Input" . $key . "\"><i class=\"far fa-envelope\"></i> E-Mail</label>";
                echo "<input aria-describedby=\"" . $key . "Input\" class=\"form-control input\" id=\"" . $key . "Input\" 
               name=\"" . $key . "\"
               placeholder=\"Enter " . $key . "\"
               value=\"" . $value . "\"
               required type=\"text\">";
                echo "</div>";
                break;

            case "passwort":
                echo "<div class=\"form-group\">";
                echo "<label class=\"label\" for=\"Input" . $key . "\"><i class=\"fas fa-key\"></i> Altes Passwort *</label>";
                echo "<input aria-describedby=\"" . $key . "Input\" class=\"form-control input\" id=\"" . $key . "Input\" 
               name=\"old_" . $key . "\"
               placeholder=\"Enter " . $key . "\"
               type=\"password\"
               required type=\"text\">";
                echo "<small id=\"old_password\" class=\"form-text text-muted\">* Zum erstellen eines neuen Passworts ist das alte notwendig!</small>";
                echo "</div>";
                echo "<div class=\"form-group\">";
                echo "<label class=\"label\" for=\"Input" . $key . "\"><i class=\"fas fa-key\"></i> Neues Passwort</label>";
                echo "<input aria-describedby=\"" . $key . "Input\" class=\"form-control input\" id=\"" . $key . "Input\" 
               name=\"" . $key . "\"
               placeholder=\"Enter " . $key . "\"
               type=\"password\"
               required type=\"text\">";
                echo "</div>";
                break;

            default:
                echo "<div class=\"form-group\">";
                echo "<label class=\"label\" for=\"Input" . $key . "\"><i class=\"fas fa-user-tie\"></i> " . $key . " </label>";
                echo "<input aria-describedby=\"" . $key . "Input\" class=\"form-control input\" id=\"" . $key . "Input\" 
               name=\"" . $key . "\"
               placeholder=\"Enter " . $key . "\"
               value=\"" . $value . "\"
               required type=\"text\">";
                echo "</div>";
                break;

        }
    }

    public static function sendUserData()
    {

    }
}
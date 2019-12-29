<?php


namespace webapp_php_sample_class;


class UserConfig
{
    public static function loadConfigTable() {
        self::tableGenerator();
    }

    public static function sendUserData() {

    }

    private static function tableGenerator() {
        $userData = self::getUserData($_SESSION['login_User']);

        echo "<form class='form-session' method='post' target='_self'>";

        foreach ($userData as $key => $value) {
            echo "<div class=\"form-group\">";
            echo "<label class=\"label\" for=\"Input" . $key . "\">" . $key . "</label>";
            echo "<input aria-describedby=\"" . $key . "Input\" class=\"form-control input\" id=\"" . $key . "Input\" 
               name=\"username\"
               placeholder=\"Enter " . $key . "\"
               value=\"" . $value . "\"
               required type=\"text\">";
            echo "</div>";
        }
        echo "<button type='submit' class='btn btn-success'>Save</button>";
        echo "</form>";
    }

    private static function getUserData($userName) {
        $userDataFilter = ["userRank"];
        $userDataArray = [];
        $userData = DatabaseHandler::createSqlRequest(
            "select",
            "usr",
            ["*"],
            null,
            "WHERE userName = '" . $userName . "'");
        $userPassword = DatabaseHandler::createSqlRequest(
            "select",
            "passWd",
            ["*"],
            null,
            "WHERE UID = '" . $userData[0] . "'");
        
        return $userDataArray;
    }
}
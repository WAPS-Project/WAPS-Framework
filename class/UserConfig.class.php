<?php


namespace webapp_php_sample_class;


class UserConfig
{
    public static function loadConfigTable(): void
    {
        self::tableGenerator();
        echo '<script>console.log("Config Page loaded")</script>';
    }

    private static function tableGenerator(): void
    {
        $userData = self::getUserData($_SESSION['login_User']);

        echo "<form class='form-session' method='post' target='_self'>";

        foreach ($userData as $item) {
            foreach ($item as $key => $value) {
                if ($key !== 'passwort') {
                    self::tableModule($key, $value);
                }
            }
        }
        echo '<input type="text" name="requestMode" value="userData" hidden />';
        echo "<button type='submit' class='btn btn-success'>Speichern</button>";
        echo ' | ';
        echo "<button type='reset' class='btn btn-danger'>Reset</button>";
        echo '</form>';

        echo "<form class='form-session' method='post' target='_self'>";

        foreach ($userData as $item) {
            foreach ($item as $key => $value) {
                if ($key === 'passwort') {
                    self::tableModule($key, $value);
                }
            }
        }

        echo '<input type="text" name="requestMode" value="password" hidden />';
        echo "<button type='submit' class='btn btn-success'>Speichern</button>";
        echo ' | ';
        echo "<button type='reset' class='btn btn-danger'>Reset</button>";
        echo '</form>';
    }

    private static function getUserData($userName): array
    {
        $userDataArray = [];
        $userData = DatabaseHandler::createSqlRequest(
            'select',
            'usr',
            '*',
            null,
            " usr.userName = '" . $userName . "'");
        $userPassword = DatabaseHandler::createSqlRequest(
            'select',
            'passWd',
            '*',
            null,
            "UID = '" . $userData[0]['UID'] . "'");

        foreach ($userData as $item) {
            foreach ($item as $key => $val) {
                if ($key === 'userName'
                    || $key === 'firstName'
                    || $key === 'lastName'
                    || $key === 'email') {
                    $userDataArray[] = [$key => $val];
                }
            }
        }

        foreach ($userPassword as $item) {
            foreach ($item as $key => $val) {
                if ($key === 'passwort') {
                    $userDataArray[] = [$key => $val];
                }
            }
        }
        return $userDataArray;
    }

    private static function tableModule($key, $value): void
    {

        switch ($key) {
            case 'userName':
                echo '<div class="form-group">';
                echo '<label class="label" for="Input' . $key . '"><i class="fas fa-user-tie"></i> Username </label>';
                echo '<input aria-describedby="' . $key . 'Input" class="form-control input" id="' . $key . 'Input" 
               name="' . $key . '"
               placeholder="Enter ' . $key . '"
               value="' . $value . '"
               required type="text">';
                echo '</div>';
                break;

            case 'firstName':
                echo '<div class="form-group">';
                echo '<label class="label" for="Input' . $key . '">Vorname</label>';
                echo '<input aria-describedby="' . $key . 'Input" class="form-control input" id="' . $key . 'Input" 
               name="' . $key . '"
               placeholder="Enter ' . $key . '"
               value="' . $value . '"
               required type="text">';
                echo '</div>';
                break;

            case 'lastName':
                echo '<div class="form-group">';
                echo '<label class="label" for="Input' . $key . '">Nachname</label>';
                echo '<input aria-describedby="' . $key . 'Input" class="form-control input" id="' . $key . 'Input" 
               name="' . $key . '"
               placeholder="Enter ' . $key . '"
               value="' . $value . '"
               required type="text">';
                echo '</div>';
                break;

            case 'email':
                echo '<div class="form-group">';
                echo '<label class="label" for="Input' . $key . '"><i class="far fa-envelope"></i> E-Mail</label>';
                echo '<input aria-describedby="' . $key . 'Input" class="form-control input" id="' . $key . 'Input" 
               name="' . $key . '"
               placeholder="Enter ' . $key . '"
               value="' . $value . '"
               required type="text">';
                echo '</div>';
                break;

            case 'passwort':
                echo '<div class="form-group">';
                echo '<label class="label" for="Input' . $key . '"><i class="fas fa-key"></i> Altes Passwort *</label>';
                echo '<input aria-describedby="' . $key . 'Input" class="form-control input" id="old' . $key . 'Input" 
               name="old_' . $key . '"
               placeholder="Enter ' . $key . '"
               type="password"
               required type="text">';
                echo '<small id="old_password" class="form-text text-muted">* Zum erstellen eines neuen Passworts ist das alte notwendig!</small>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label class="label" for="Input' . $key . '"><i class="fas fa-key"></i> Neues Passwort</label>';
                echo '<input aria-describedby="' . $key . 'Input" class="form-control input" id="' . $key . 'Input" 
               name="' . $key . '"
               placeholder="Enter ' . $key . '"
               type="password"
               required type="text">';
                echo '</div>';
                break;

            default:
                echo '<div class="form-group">';
                echo '<label class="label" for="Input' . $key . '"><i class="fas fa-user-tie"></i> ' . $key . ' </label>';
                echo '<input aria-describedby="' . $key . 'Input" class="form-control input" id="' . $key . 'Input" 
               name="' . $key . '"
               placeholder="Enter ' . $key . '"
               value="' . $value . '"
               required type="text">';
                echo '</div>';
                break;

        }
    }

    public static function userDataRequest(): void
    {
        $requestMode = Main::checkPost('requestMode');
        $username = Main::checkPost('userName');
        $firstName = Main::checkPost('firstName');
        $lastName = Main::checkPost('lastName');
        $email = Main::checkPost('email');

        if ($username !== null && $firstName !== null && $lastName !== null && $email !== null) {

        }
        //ErrorHandler::FireWarning('Invalid Input', 'all input fields are required');
    }

    public static function passwordRequest(): void
    {
        $requestMode = Main::checkPost('requestMode');
        $old_passwort = Main::checkPost('old_passwort');
        $passwort = Main::checkPost('passwort');

        if ($requestMode === 'password') {
            if ($result = DatabaseHandler::createSqlRequest('select', 'usr LEFT JOIN passWd ON usr.UID = passWd.UID', ['userName', 'passwort'], null, "userName = '" . filter_var($_SESSION['login_User'], FILTER_SANITIZE_STRING))) {
                while ($result) {
                    $trust = password_verify($old_passwort, $result['passwort']);
                    if ($trust === true) {
                        DatabaseHandler::createSqlRequest('update', 'usr LEFT JOIN passWd ON usr.UID = passWd.UID', null, ['passwort'=> password_hash($passwort, PASSWORD_DEFAULT)], "userName = '" . filter_var($_SESSION['login_User'], FILTER_SANITIZE_STRING));
                        ErrorHandler::FireWarning("Done", "Request done!");
                        echo $old_passwort . ' | ' . $result['passwort'];
                    }

                    $error = 'Your Password is invalid';
                    ErrorHandler::FireError('Password', $error);
                }
            }
        }
    }
}
<?php


namespace webapp_php_sample_class;


class DatabaseHandler
{
    public static function createSqlRequest($mode, $tableName, $rows, $values, $valueString)
    {
        $db_link = StartUp::loadDatabase();
        switch ($mode) {
            case "alter":
                foreach ($rows as $row) {
                    $requestString = "ALTER TABLE " . $tableName . " ADD " . $row . $valueString;
                    mysqli_query($db_link, $requestString, MYSQLI_USE_RESULT);
                }
                break;
            case "create":
                $requestString = "CREATE TABLE " . $tableName;
                mysqli_query($db_link, $requestString, MYSQLI_USE_RESULT);
                foreach ($rows as $row) {
                    $requestString = "ALTER TABLE " . $tableName . " ADD " . $row . $valueString;
                    mysqli_query($db_link, $requestString, MYSQLI_USE_RESULT);
                }
                break;
            case "select":
                $columnJoin = join(", ", $rows);
                $requestString = "SELECT " . $columnJoin . $valueString;
                mysqli_query($db_link, $requestString, MYSQLI_USE_RESULT);
                break;
            case "update":
                foreach ($values as $key => $value) {
                    $setValue = $key . " = " . $value;
                    $requestString = "UPDATE " . $tableName . " SET " . $setValue . " WHERE " . $valueString;
                    mysqli_query($db_link, $requestString, MYSQLI_USE_RESULT);
                }
                break;
            default:
                ErrorHandler::FireWarning("Migration Warning", "No Migration mode chosen");
                break;
        }
    }
}
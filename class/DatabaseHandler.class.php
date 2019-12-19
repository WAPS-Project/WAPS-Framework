<?php


namespace webapp_php_sample_class;


use mysqli;

class Directory
{
    public static function createSqlString($mode, $tableName, $rows, $values, $valueString)
    {
        $db_link = StartUp::loadDatabase();
        switch ($mode) {
            case "alter":
                $requestString = "ALTER TABLE " . $tableName;
                mysqli_query($db_link, $requestString, MYSQLI_USE_RESULT);
                break;
            case "create":
                $requestString = "CREATE TABLE " . $tableName . "(" . $rows . ");";
                mysqli_query($db_link, $requestString, MYSQLI_USE_RESULT);
                break;
            case "select":
                $requestString = "SELECT";
                mysqli_query($db_link, $requestString, MYSQLI_USE_RESULT);
                break;
            case "update":
                $requestString = null;
                mysqli_query($db_link, $requestString, MYSQLI_USE_RESULT);
                break;
            default:
                ErrorHandler::FireWarning("Migration Warning", "No Migration mode chosen");
                break;
        }
    }
}
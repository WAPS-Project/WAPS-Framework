<?php


namespace webapp_php_sample_class;


class DatabaseHandler
{
    public static function createSqlRequest($mode, $tableName, $rows, $values, $valueString)
    {
        $db_link = StartUp::loadDatabase();
        switch ($mode) {
            case "insert":
                $joinRow = join(", ", $rows);
                $valueRow = join(", ", $values);
                $requestString = "INSERT INTO " . $tableName . "  (" . $joinRow . ") (" . $valueRow . ")";
                $db_link->query($requestString);

            case "alter":
                foreach ($rows as $row => $datatype) {
                    $requestString = "ALTER TABLE " . $tableName . " ADD " . $row . " " . $datatype;
                    $db_link->query($requestString);
                }
                break;
            case "create":
                $requestString = "CREATE TABLE " . $tableName;
                $db_link->query($requestString);
                foreach ($rows as $row => $datatype) {
                    $requestString = "ALTER TABLE " . $tableName . " ADD " . $row . $valueString;
                    $db_link->query($requestString);
                }
                break;
            case "select":
                if (gettype($rows) === "array") {
                    $rows = join(", ", $rows);
                }
                $requestString = "SELECT " . $rows . " " . $valueString;

                if ($result = $db_link->query($requestString, MYSQLI_USE_RESULT)) {
                    while ($obj = $result->fetch_array($result)) {
                        return $obj;
                    }
                }

                break;
            case "update":
                foreach ($values as $key => $value) {
                    $setValue = $key . " = " . $value;
                    $requestString = "UPDATE " . $tableName . " SET " . $setValue . " WHERE " . $valueString;
                    $db_link->query($requestString, MYSQLI_USE_RESULT);
                }
                break;
            default:
                ErrorHandler::FireWarning("Database Warning", "No Sql request mode chosen");
                break;
        }
    }
}
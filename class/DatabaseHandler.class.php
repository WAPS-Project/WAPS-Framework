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
                if ($result = $db_link->query($requestString)) {
                    return $result;
                } else {
                    return false;
                }
                break;

            case "alter":
                foreach ($rows as $row => $datatype) {
                    $requestString = "ALTER TABLE " . $tableName . " ADD " . $row . " " . $datatype;
                    if ($result = $db_link->query($requestString)) {
                        return $result;
                    } else {
                        return false;
                    }
                }
                break;
            case "create":
                $check = null;
                $tableRows = [];
                foreach ($rows as $key => $data) {
                    array_merge($tableRows, [$key . " " . "data"]);
                }
                $joinRow = join(", ", $tableRows);
                $requestString = "CREATE TABLE " . $tableName . " ( " . $joinRow . " ) ";
                if ($db_link->query($requestString)) {
                    $check = true;
                } else {
                    $check = false;
                    echo "create request failed \n";
                    die();
                }
                if ($check === false) {
                    echo "something went wrong \n";
                }
                break;
            case "select":
                if (gettype($rows) === "array") {
                    $rows = join(", ", $rows);
                }
                if ($valueString != null) {
                    $requestString = "SELECT " . $rows . " FROM " . $tableName . " WHERE " . $valueString;
                } else {
                    $requestString = "SELECT " . $rows . " FROM " . $tableName;
                }

                if ($result = $db_link->query($requestString, MYSQLI_USE_RESULT)) {
                    while ($obj = $result->fetch_all()) {
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
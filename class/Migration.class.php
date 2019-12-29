<?php


namespace webapp_php_sample_class;


use Exception;

class Migration
{
    public static function listMigrations()
    {
        $files = array_diff(scandir(MIGRATION_PATH), DEFAULT_FILE_FILTER);
        if ($files != null) {
            echo "\n";
            foreach ($files as $file) {
                echo $file . "\n";
            }
        } else {
            echo "There are no Migrations!";
        }
        echo "\n";
    }

    public static function createSimpleModelMigration()
    {
        $path = "./core/database/model/";
        $migrationPath = "./core/database/migrations/";
        $models = array_diff(scandir($path), DEFAULT_FILE_FILTER);

        $migrationList[] = DatabaseHandler::createSqlRequest("select", "migrations", ["*"], null, null);

        $count = 0;
        $bound = 0;

        foreach ($models as $model) {
            $migrations = array_diff(scandir($migrationPath), DEFAULT_FILE_FILTER);
            $mList = [];
            foreach ($migrations as $m) {
                $migrationParts = explode(".", $m);
                $migrationSubParts = explode("_", $migrationParts[0]);
                array_push($mList, $migrationSubParts[1]);
            }
            $fileParts = explode(".", $model);
            try {
                include_once $path . $model;
                $class = new $fileParts[0];
            } catch (Exception $e) {
                ErrorHandler::FireCLIError($e->getCode(), $e->getMessage());
            }

            $classVars = get_class_vars(get_class($class));
            $className = get_class($class);
            $classMethodArray = [];

            foreach ($classVars as $classVar => $key) {
                $value = gettype($key);
                if ($value === "integer") {
                    $value = "INT";
                }
                if ($value === "string") {
                    $value = "VARCHAR(255)";
                }
                array_push($classMethodArray, [$classVar => $value]);
            }

            if (!in_array($fileParts[0], $mList)) {
                if (!in_array($fileParts[0], $migrationList)) {
                    $count++;
                    self::createMigration($className, "create", $className, $classMethodArray, null, null);
                } else {
                    self::createMigration($className, "alter", $className, $classMethodArray, null, null);
                }
            } else {
                $bound++;
                echo "The migration you want to create is already existing\n";
            }
        }

        if ($count === 0 && $bound === 0) {
            echo "There are no new migrations";
        }
    }

    public static function createMigration($migrationName, $mode, $tableName, $rows, $values, $valueString)
    {
        $migrationPreset = date("YmdHis");
        $migrationFileName = $migrationPreset . "_" . $migrationName . ".migration.json";

        $migrationFileContent = [
            "Name" => $migrationName,
            "Mode" => $mode,
            "Table_Name" => $tableName,
            "Rows" => $rows,
            "Values" => $values,
            "Value_String" => $valueString
        ];

        $files = array_diff(scandir(MIGRATION_PATH), DEFAULT_FILE_FILTER);

        if (!in_array($migrationFileName, $files)) {
            $workFile = fopen(MIGRATION_PATH . $migrationFileName, "w");
            fwrite($workFile, json_encode($migrationFileContent));
            fclose($workFile);
        }
    }

    public static function loadMigrations()
    {
        $files = array_diff(scandir(MIGRATION_PATH), DEFAULT_FILE_FILTER);
        if ($files != null) {
            foreach ($files as $file) {
                try {
                    $fileOpen = fopen(MIGRATION_PATH . $file, "r");
                    $json = fread($fileOpen, filesize(MIGRATION_PATH . $file));
                    $migration = json_decode($json, true);
                    $mode = $migration["Mode"];
                    $tName = $migration["Table_Name"];
                    $rows = $migration["Rows"];
                    $values = $migration["Values"];
                    $valueString = $migration["Value_String"];

                    DatabaseHandler::createSqlRequest($mode, $tName, $rows, $values, $valueString);

                    DatabaseHandler::createSqlRequest(
                        "insert",
                        "migrations",
                        ["migrationName", "TS", "DT"],
                        [$tName, date("H:i:s"),
                            date("Y-m-d")],
                        null
                    );
                } catch (Exception $e) {
                    ErrorHandler::FireCLIError($e->getCode(), $e->getMessage());
                }
            }
            return true;
        } else {
            echo "There are no Migrations!";
            return false;
        }
    }

    public static function checkFiredMigrations()
    {
        return DatabaseHandler::createSqlRequest(
            "select",
            "migrations",
            ["*"],
            null,
            null);
    }
}
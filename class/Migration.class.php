<?php


namespace webapp_php_sample_class;


use Exception;

class Migration
{
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

    public static function listMigrations()
    {
        $files = array_diff(scandir(MIGRATION_PATH), DEFAULT_FILE_FILTER);
        if ($files != null) {
            echo "\n";
            foreach ($files as $file) {
                echo "$ " . $file;
            }
        } else {
            echo "There are no Migrations!";
        }
        echo "\n";
    }

    public static function createSimpleModelMigration()
    {

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
                    try {
                        DatabaseHandler::createSqlRequest(
                            $mode,
                            $tName,
                            $rows,
                            $values,
                            $valueString
                        );
                    } catch (Exception $e) {
                        JsonHandler::FireSimpleJson($e->getCode(), $e->getMessage());
                    }

                } catch (Exception $e) {
                    JsonHandler::FireSimpleJson($e->getCode(), $e->getMessage());
                }
            }
            echo "\n Migrations done! \n";
        } else {
            echo "There are no Migrations!";
        }
    }
}
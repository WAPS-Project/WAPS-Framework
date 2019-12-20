<?php


namespace webapp_php_sample_class;


class Migration
{
    const MIGRATION_PATH = "./core/database/migrations/";

    public function migrate()
    {
        self::loadMigrations();
    }

    public static function createMigration($migrationName, $mode, $tableName, $rows, $values, $valueString)
    {
        $migrationPreset = date("YmdHis");
        $migrationFileName = $migrationPreset . "_" . $migrationName . ".migration.php";
        $migrationClassName = $migrationPreset . "_" . $migrationName;

        $migrationFileContent = self::createMigrationHead($migrationClassName)
            . "DatabaseHandler::createSqlRequest(" . $mode . $tableName . $rows . $values . $valueString .");}}"
            . self::createMigrationFooter();

        $files = array_diff(scandir(self::MIGRATION_PATH), DEFAULT_FILE_FILTER);

        if (!in_array($migrationFileName, $files)) {
            $workFile = fopen(MIGRATION_PATH . $migrationFileName, "w");
            fwrite($workFile, $migrationFileContent);
            fclose($workFile);
        }
    }

    public static function loadMigrations()
    {
        $files = array_diff(scandir(self::MIGRATION_PATH), DEFAULT_FILE_FILTER);
        if ($files != null) {
            foreach ($files as $file) {
                include self::MIGRATION_PATH . $file;
            }
        } else {
            echo "There are no Migrations!";
        }
    }

    public static function listMigrations()
    {
        $files = array_diff(scandir(self::MIGRATION_PATH), DEFAULT_FILE_FILTER);
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

    private static function createMigrationHead($migrationClassName):string
    {
        return "<?php

         namespace webapp_php_sample_migration;
         use webapp_php_sample_class\DatabaseHandler;

         class "
        . $migrationClassName .
        "
         {
         public static function main() {
         ";
    }

    private static function createMigrationFooter():string
    {
        return "example::main();";
    }
}
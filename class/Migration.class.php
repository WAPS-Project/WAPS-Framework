<?php


namespace webapp_php_sample_class;


class Migration
{
    const MIGRATION_PATH = "./core/database/migrations/";

    public function migrate()
    {
        self::loadMigrations();
    }

    public function createMigration($migrationName, $query)
    {
        $migrationPreset = date("YmdHis");
        $migrationFileName = $migrationPreset . "_" . $migrationName . ".php";
        $migrationClassName = $migrationPreset . "_" . $migrationName;

        $migrationHead = "
        <?php
        
        namespace webapp_php_sample_migration;
        
        class " . $migrationClassName .
            "
        
        ";


    }

    private function loadMigrations()
    {
        $files = array_diff(scandir(self::MIGRATION_PATH), DEFAULT_FILE_FILTER);
        foreach ($files as $file) {
            include self::MIGRATION_PATH . $file;
        }
    }

    private function generateSql($query)
    {

    }
}
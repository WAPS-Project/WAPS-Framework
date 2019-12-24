<?php

use webapp_php_sample_class\cli;
use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\Migration;

$command = "start";
$help = [
    "help" => "is used to show all commands",
    "exit" => "exits the cli",
    "migrate" => "runs the migrations against the Database",
    "create" => "creates a migration based on the model classes",
    "list" => "lists all migrations",
    "custom" => "create a custom migration based on the user inputs"
];

$helpC = [
    "help" => "is used to show all commands",
    "create table" => "is used to create a new table",
    "alter table" => "is used to update/ad table entries",
    "update table" => "is used to update table columns"
];
cli::designHelp($help);
while ($command != "exit") {
    cli::designLine();
    $command = str_replace('/\s+/', '', cli::designInput());

    switch ($command) {

        case "help":
            cli::designHelp($help);
            break;

        case "create":
            Migration::createSimpleModelMigration();
            break;

        case "custom":
            echo "What kind of migration do you want to create? \n";
            cli::designHelp($helpC);
            $migrateMode = null;
            while ($migrateMode != "exit") {
                $migrateMode = cli::designInput();

                switch ($migrateMode) {
                    case "create table":
                        echo "What is the name of your Migration? \n";
                        $mName = cli::designInput();
                        echo "What is the name of your Table? \n";
                        $tName = cli::designInput();
                        echo "How many columns do you want to ad? \n";
                        $cSum = null;
                        while ($cSum === null) {
                            try {
                                $cSum = intval(cli::designInput());
                            } catch (Exception $e) {
                                $cSum = null;
                                ErrorHandler::FireCLIError($e->getCode(), $e->getMessage());
                            }
                        }

                        $rows = [];

                        for ($i = 0; $i < $cSum; $i++) {
                            echo "Please enter the column Name: \n";
                            $key = cli::designInput();
                            echo "Please enter the column restrictions \n";
                            $val = cli::designInput();
                            $pair = [$key => $val];
                            array_push($rows, $pair);
                        }
                        Migration::createMigration($mName, "create", $tName, $rows, null, null);
                        echo "\n";
                        echo "Migration created!";
                        echo "\n";
                        break;

                    case "help":
                        cli::designHelp($helpC);
                        break;

                    default:
                        echo "Please enter a valid mode";
                        break;
                }

            }
            break;

        case "migrate":
            echo "\n";
            Migration::loadMigrations();
            break;

        case "list":
            echo "\n";
            echo "List: \n";
            Migration::listMigrations();
            break;

        case "exit":
            $command = "exit";
            break;

        default:
            cli::designLine();
            echo "Please use a valid command!";
            break;
    }
}
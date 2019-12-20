<?php

use webapp_php_sample_class\cli;
use webapp_php_sample_class\Migration;

$command = "start";

while ($command != "exit") {
    cli::designLine();
    $command = str_replace('/\s+/', '', cli::designInput());

    switch ($command) {
        case "help":
            $help = [
                "help"=>"is used to show all commands",
                "exit"=>"exits the cli",
                "migrate"=>"runs the migrations against the Database",
                "create"=>"starting the creation of a new migration",
                "list"=>"lists all migrations"
            ];
            cli::designHelp($help);
            break;

        case "create":
            echo "wat kind of migration do you want to create";
            Migration::createMigration("", "", "", "", "", "");

        case "migrate":
            echo "\n";
            Migration::loadMigrations();
            break;

        case "list":
            echo "\n";
            echo "List: ";
            Migration::listMigrations();
            break;

        case "exit":
            $command = "exit";
            break;

        default:
            cli::designLine();
            echo "Please use a valid command!";
    }
}
<?php

use webapp_php_sample_class\cli;

$command = "start";

while ($command != "exit") {
    cli::designLine();
    $command = cli::designInput();

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

        case "exit":
            $command = "exit";
            break;

        default:
            cli::designLine();
            echo "Please use a valid command!";
    }
}
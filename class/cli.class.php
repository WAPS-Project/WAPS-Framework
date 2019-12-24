<?php


namespace webapp_php_sample_class;


class cli
{
    static function designLine() {
        echo "\n--------------------------------------------------------------\n";
    }

    static function designInput() {
        echo "\nPlease enter a command: \n";
        return $command = readline("$ ");
    }

    static function designHelp($helpEntries) {
        echo "\n";
        foreach ($helpEntries as $helpName => $helpEntry) {
            echo $helpName . "           - " . $helpEntry . "\n";
        }
    }

    static function checkIfCli() {
        if (PHP_SAPI != "cli") {
            ErrorHandler::FireCLIError("No CLI Error", "The Interface you use isn't a valid CL");
            die();
        }
    }

}
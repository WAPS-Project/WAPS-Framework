<?php


namespace webapp_php_sample_class;


class cli
{
    static function designLine() {
        echo "\n";
        echo "--------------------------------------------------------------\n";
        echo "--------------------------------------------------------------\n";
        echo "\n";
    }

    static function designInput() {
        echo "Please enter a command: \n";
        echo "\n";
        return $command = readline("$ ");
    }

    static function designHelp($helpEntries) {
        echo "\n";
        foreach ($helpEntries as $helpName => $helpEntry) {
            echo $helpName . "           - " . $helpEntry . "\n";
        }
        echo  "\n";
    }

    static function checkIfCli() {
        if (PHP_SAPI != "cli") {
            die();
        }
    }

}
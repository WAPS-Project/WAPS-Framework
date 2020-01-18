<?php


namespace webapp_php_sample_class;


class cli
{
    public static function designLine()
    {
        echo "\n--------------------------------------------------------------\n";
    }

    public static function designInput(): string
    {
        echo "\nPlease enter a command: \n";
        return readline('$ ');
    }

    public static function designHelp($helpEntries)
    {
        echo "\n";
        foreach ($helpEntries as $helpName => $helpEntry) {
            echo $helpName . '           - ' . $helpEntry . "\n";
        }
    }

    public static function checkIfCli()
    {
        if (PHP_SAPI !== 'cli') {
            ErrorHandler::FireCLIError('No CLI Error', 'The Interface you use isn\'t a valid CL');
            die();
        }
    }

}
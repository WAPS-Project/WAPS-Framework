<?php


use webapp_php_sample_class\build;
use webapp_php_sample_class\cli;
use webapp_php_sample_class\Migration;

$command = 'start';
$help = [
    'help' => 'is used to show all commands',
    'exit' => 'exits the cli',
    'deploy' => 'deploy the app'
];

cli::designHelp($help);
while ($command !== 'exit') {
    cli::designLine();
    $command = str_replace('/\s+/', '', cli::designInput());

    switch ($command) {

        case 'help':
            cli::designHelp($help);
            break;

        case 'create':
            Migration::createSimpleModelMigration();
            break;

        case 'deploy':
            build::copyFiles('../framework.scr', '../framework.dist');
            break;

        case 'exit':
            $command = 'exit';
            break;

        default:
            cli::designLine();
            echo 'Please use a valid command!';
            break;
    }
}
<?php


use webapp_php_sample_class\build;
use webapp_php_sample_class\cli;
use webapp_php_sample_class\Migration;

$command = 'start';
$help = [
    'help' => 'is used to show all commands',
    'exit' => 'exits the cli',
    'run' => 'deploy the app'
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

        case 'run':
            cli::designLine();
            build::setupDir('../framework.dist');
            build::copyFiles('../framework.scr/class', '../framework.dist/class');
            build::copyFiles('../framework.scr/config', '../framework.dist/config');
            build::copyFiles('../framework.scr/dist', '../framework.dist/dist');
            build::copyFiles('../framework.scr/core', '../framework.dist/core');
            build::copyFiles('../framework.scr/custom', '../framework.dist/custom');
            build::copyFiles('../framework.scr/object', '../framework.dist/object');
            build::copyFiles('../framework.scr/page', '../framework.dist/page');
            build::copyFiles('../framework.scr/.htaccess', '../framework.dist/.htaccess');
            build::copyFiles('../framework.scr/API.php', '../framework.dist/API.php');
            build::copyFiles('../framework.scr/CLI.php', '../framework.dist/CLI.php');
            build::copyFiles('../framework.scr/index.php', '../framework.dist/index.php');
            build::copyFiles('../framework.scr/robots.txt', '../framework.dist/robots.txt');

            echo 'Deploy done!';
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
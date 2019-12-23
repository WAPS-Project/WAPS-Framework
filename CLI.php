<?php

use webapp_php_sample_class\cli;

include "core/loader/basic.loader.php";

$CLIString = "./core/CLI/";

$CLIFiles = array_diff(scandir($CLIString), DEFAULT_FILE_FILTER);

cli::checkIfCli();

$command = null;

echo "commands:\n";

foreach ($CLIFiles as $file) {
    $fileName = explode(".", $file);
    echo "    " . $fileName[0] . "\n";
}

echo "\n\n";

$mode = readline("Please insert the cli mode you want to use: \n");

if (!in_array($mode . ".CLI.php", $CLIFiles)) {
    echo "The command you used is invalid";
    readline();
    die();
}

foreach ($CLIFiles as $file) {
    $fileName = explode(".", $file);

    if ($fileName[0] === $mode) {
        include $CLIString . $file;
    }
}
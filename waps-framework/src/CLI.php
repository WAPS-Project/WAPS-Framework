<?php

use Waps\Framework\Core\ErrorHandler;
use Waps\Framework\Console\Command;

require_once __DIR__ . '/../vendor/autoload.php';

$CLIString = __DIR__ . "/core/CLI/";

$_ErrorHandler = new ErrorHandler("cli");

$CLIFiles = array_diff(scandir($CLIString), array('.', '..'));

Command::checkIfCli();

$command = null;

echo "commands:\n";

foreach ($CLIFiles as $file) {
	$fileName = explode(".", $file);
	echo "    " . $fileName[0] . "\n";
}

echo "\n\n";

$mode = readline("Please insert the cli mode you want to use: \n");

while (!in_array($mode . ".CLI.php", $CLIFiles, true)) {
	echo "The command you used is invalid \n";

	$mode = Command::designInput();
}

foreach ($CLIFiles as $file) {
	$fileName = explode(".", $file);

	if ($fileName[0] === $mode) {
		include $CLIString . $file;
	}
}

<?php

// check OS
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
	$os = 'win';
} else {
	$os = 'nix';
}

// check if os is mac
if (strtoupper(substr(PHP_OS, 0, 3)) === 'MAC') {
	$os = 'mac';
}

// check PHP version
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
	die('PHP 5.3.0 or higher is required!');
}

// get the name of the OS
if ($os == 'win') {
	$os_name = 'windows';
} elseif ($os == 'mac') {
	$os_name = 'mac';
} else {
	$os_name = 'linux';
}

$DEPLOY_TARGET = '"./framework.dist"';
// C:/xampp/htdocs
// ./framework.dist

echo "Identifyed OS: $os_name\n";
echo "Deploying to $DEPLOY_TARGET\n";
switch ($os) {
	case 'win':
		system("rd /s /q $DEPLOY_TARGET");

		system("mkdir $DEPLOY_TARGET");

		echo "Copy folder contents of framework.src to deploy target: $DEPLOY_TARGET\n";
		system("xcopy framework.src $DEPLOY_TARGET /s /e /y");
		break;
	case 'nix':
		system("rm -rf $DEPLOY_TARGET");

		system("mkdir $DEPLOY_TARGET");

		echo "Copy folder contents of framework.src to deploy target: $DEPLOY_TARGET\n";
		system("cp -r framework.src $DEPLOY_TARGET");
		break;
}

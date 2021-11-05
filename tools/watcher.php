<?php

// generate a function that watches files for changes
function watcher($path, $callback) {
	$files = array();
	$dirs = array();
	$dir = opendir($path);
	while ($file = readdir($dir)) {
		if ($file == '.' || $file == '..') {
			continue;
		}
		$fullpath = $path . '/' . $file;
		if (is_dir($fullpath)) {
			$dirs[] = $fullpath;
		} else {
			$files[] = $fullpath;
		}
	}
	closedir($dir);
	$callback($files, $dirs);
	foreach ($dirs as $dir) {
		watcher($dir, $callback);
	}
}

// generate a function that runs a command
function run($command) {
	echo "Running: $command\n";
	system($command);
}

// generate a function that watches if a file has changed
function file_watcher($file, $callback) {
	$mtime = filemtime($file);
	while (true) {
		if (filemtime($file) != $mtime) {
			$mtime = filemtime($file);
			$callback();
		}
		sleep(1);
	}
}

// generate a function that watches if a directory changed
function dir_watcher($dir, $callback) {
	$mtime = filemtime($dir);
	while (true) {
		if (filemtime($dir) != $mtime) {
			$mtime = filemtime($dir);
			$callback();
		}
		sleep(1);
	}
}

// generate a function that starts a function in a fiber
function fiber($callback) {
	$fiber = new Fiber(function() use ($callback) {
		$callback();
	});
	$fiber->start();
}

watcher('./framework.src', function ($files, $dirs) {
	foreach ($files as $file) {
		fiber(function() use ($file) {
			file_watcher($file, function() use ($file) {
				run('npm run deploy');
			});
		});
	}
	foreach ($dirs as $dir) {
		fiber(function() use ($dir) {
			dir_watcher($dir, function() use ($dir) {
				run('npm run deploy');
			});
		});
	}
});

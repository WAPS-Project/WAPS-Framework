<?php

print("Starting watcher...");
print("\n");

function watcher($path, $callback): void {
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

function run($command): void {
	echo "Running: $command\n";
	system($command);
}

function file_watcher($file, $callback): void {
	$mtime = filemtime($file);
	print("Watching $file\n");
	while (true) {
		if (filemtime($file) != $mtime) {
			$mtime = filemtime($file);
			$callback();
		}
		sleep(1);
	}
}

function dir_watcher($dir, $callback): void {
	$mtime = filemtime($dir);
	print("Watching $dir\n");
	while (true) {
		if (filemtime($dir) != $mtime) {
			$mtime = filemtime($dir);
			$callback();
		}
		sleep(1);
	}
}

function fiber($callback): void {
	$fiber = new Fiber(function() use ($callback) {
		$callback();
	});
	$fiber->start();
}

watcher('./framework.src', function ($files, $dirs) {
	foreach ($files as $file) {
		fiber(function() use ($file): void {
			file_watcher($file, function() use ($file) {
				print("$file changed\n");
				run('npm run deploy');
			});
		});
	}
	foreach ($dirs as $dir) {
		fiber(function() use ($dir): void {
			dir_watcher($dir, function() use ($dir) {
				print("$dir changed\n");
				run('npm run deploy');
			});
		});
	}
});


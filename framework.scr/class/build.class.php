<?php


namespace webapp_php_sample_class;


use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class build
{
    public static function copyFiles($source, $dest)
    {
        if(is_dir($source)) {
            $dir = opendir($source);
            @mkdir($dest);
            while (($file = readdir($dir))) {
                if (($file != '.') && ($file != '..')) {
                    if (is_dir($source . '/' . $file)) {
                        self::copyFiles($source . '/' . $file, $dest . '/' . $file);
                    } else {
                        copy($source . '/' . $file, $dest . '/' . $file);
                    }
                }
            }
            closedir($dir);
        } else {
            copy($source, $dest);
        }
    }

    public static function setupDir($dirPath) {
        if (! is_dir($dirPath)) {
            mkdir($dirPath, 0755, true);
        }
        $it = new RecursiveDirectoryIterator($dirPath, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
            RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->isDir()){
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($dirPath);
        if (!file_exists($dirPath)) {
            mkdir($dirPath, 0755, true);
        }
    }


}
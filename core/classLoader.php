<?php

function classLoader() {
    $files = scandir("class/");
    $classConfig = "config/class.config.php";
    unlink($classConfig);
    chmod($classConfig, 0777);

    $phpConfig = fopen($classConfig, "a");

    foreach ($files as $file) {
        $fileParts = explode($file, ".");

        if ($fileParts[1] === "class" && $fileParts[2] === "php") {
            fwrite($classConfig, "<?php require('" + $file + "') ?>");
        }
    }

    fclose($classConfig);
}
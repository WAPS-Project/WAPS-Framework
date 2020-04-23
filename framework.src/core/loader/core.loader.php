<?php

use webapp_php_sample_class\ConfigLoader;

$classString = './class/';
$modelString = './model/';
$configString = './config/';

$objFiles = array_diff(scandir($modelString), array('.', '..'));
$classFiles = array_diff(scandir($classString), array('.', '..'));

foreach ($objFiles as $singleObj) {
    include $modelString . $singleObj;

}
foreach ($classFiles as $singleClass) {
    $classParts = explode('.', $singleClass);
    if ($classParts[1] === 'class') {
        include $classString . $singleClass;
    }
}

ConfigLoader::loadConfig($configString);
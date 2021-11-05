<?php

$DEPLOY_TARGET = '"C:/xampp/htdocs"';
// C:/xampp/htdocs
// ./framework.dist

// remove deploy target
system("rd /s /q $DEPLOY_TARGET");

// create deploy target
system("mkdir $DEPLOY_TARGET");

// copy folder contents of framework.src to deploy target
echo "Copy folder contents of framework.src to deploy target: $DEPLOY_TARGET\n";
system("xcopy framework.src $DEPLOY_TARGET /s /e /y");

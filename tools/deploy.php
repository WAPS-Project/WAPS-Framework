<?php

$DEPLOY_TARGET = '"C:/xampp/htdocs"';
// C:/xampp/htdocs
// ./framework.dist

system("rd /s /q $DEPLOY_TARGET");

system("mkdir $DEPLOY_TARGET");

echo "Copy folder contents of framework.src to deploy target: $DEPLOY_TARGET\n";
system("xcopy framework.src $DEPLOY_TARGET /s /e /y");

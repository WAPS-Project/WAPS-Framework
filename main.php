<?php

namespace webapp_php_sample;

use webapp_php_sample_class\StartUp;

class main
{
    static function main()
    {
        StartUp::createDatabase();
        StartUp::classDirCheck();

    }

}
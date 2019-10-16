<?php

namespace webapp_php_sample;


use webapp_php_sample_class\StartUp;

class main
{
    function main()
    {
        StartUp::createDatabase();
    }

}
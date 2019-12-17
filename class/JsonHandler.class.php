<?php


namespace webapp_php_sample_class;


class JsonHandler
{
    static function FireSimpleJson($key, $value) {
        $array = [[$key=>$value]];
        $json = self::BuildJson($array);
        echo $json;
    }

    static function FireComplexResponse($array) {

    }

    static function BuildJson($objectArray) {
        $arrayMaster = [];
        foreach ($objectArray as $value) {
            array_push($arrayMaster, $value);
        }
        return json_encode($arrayMaster);
    }
}
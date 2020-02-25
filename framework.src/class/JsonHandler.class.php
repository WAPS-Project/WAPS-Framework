<?php


namespace webapp_php_sample_class;


class JsonHandler
{
    public static function FireSimpleJson($key, $value): void
    {
        $array = [[$key => $value]];
        $json = self::BuildJson($array);
        echo $json;
    }

    public static function BuildJson($objectArray)
    {
        $arrayMaster = [];
        foreach ($objectArray as $value) {
            $arrayMaster[] = $value;
        }
        return json_encode($arrayMaster, JSON_THROW_ON_ERROR, 512);
    }

    public static function FireComplexResponse($array): void
    {

    }
}
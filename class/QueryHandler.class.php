<?php


namespace webapp_php_sample_class;


class QueryHandler
{
    public static function validateQuery($queryString) {

    }

    protected static function filterQuery($queryString) {
        $querySplit = explode("--", $queryString);
        $queryJoin = implode(" ", $querySplit);
        $querySplit = explode(" ", $queryJoin);
    }
}
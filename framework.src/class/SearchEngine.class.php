<?php

namespace webapp_php_sample_class;

class SearchEngine
{
    public static function search($searchString): void
    {
        $searchList = self::searchFilter($searchString);
        $pageContent = self::pageQuery();
    }

    private static function searchFilter($searchGlobal): array
    {
        return explode('|',
            implode('',
                array_diff(
                    str_split(
                        filter_var(
                            implode('|', explode(' ', $searchGlobal)), FILTER_SANITIZE_STRING)),
                    DEFAULT_SEARCH_FILTER)));
    }

    private static function pageQuery(): array
    {
        $path = './page/open/';
        $pages = array_diff(scandir($path), DEFAULT_FILE_FILTER);
        $result = [];

        foreach ($pages as $page) {
            $pParts = explode('.', $page);
            $pName = $pParts[0];

            $f = fopen($path . $page, 'rb');
            $fContent = self::searchFilter(fread($f, filesize($path . $page)));
            $result[] = [$pName => $fContent];
            fclose($f);
        }

        return $result;
    }
}

<?php

namespace webapp_php_sample_class;

class SearchEngine
{
    public static function search($searchString): object {
        $searchList = self::searchQuest($searchString);
        $pageContent = self::pageQuery();
    }

    private static function searchQuest($searchGlobal): array
    {
        $words = explode(' ', $searchGlobal);
        return explode(', ',
            implode('',
                array_diff(
                    str_split(
                        filter_var(
                            implode(', ', $words), FILTER_SANITIZE_STRING)),
                        DEFAULT_SEARCH_FILTER)));
    }

    private static function pageQuery() {
        $path = './page/open/';
        $pages = array_diff(scandir($path), DEFAULT_FILE_FILTER);
        $firstResult = [];

        foreach ($pages as $page) {
            $pageParts = explode('.', $page);
            $pageName = $pageParts[0];
            $fileContent = self::searchQuest(file_get_contents($path . $page));
            $firstResult[] = [$pageName => $fileContent];
        }

        return $firstResult;
    }
}

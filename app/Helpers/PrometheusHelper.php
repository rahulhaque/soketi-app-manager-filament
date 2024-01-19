<?php

use Illuminate\Support\Collection;

if (! function_exists('parse_prometheus')) {
    function parse_prometheus(string $key, string $metrics): Collection
    {
        preg_match_all('`^('.$key.'){(.+?)}\s+(\d+)$`im', $metrics, $matches, PREG_SET_ORDER, 0);

        return collect($matches)->map(function ($item) {
            $labelPairs = explode(',', $item[2]);
            $json = [];

            foreach ($labelPairs as $pair) {
                [$key, $value] = explode('=', $pair);
                $json[$key] = trim($value, '"');
            }

            return ['key' => $item[1], 'json' => $json, 'value' => $item[3]];
        });
    }
}

<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Metrics Enabled
    |--------------------------------------------------------------------------
    |
    | Set the metrics to show or not in dashboard.
    |
    */

    'enabled' => env('METRICS_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Metrics Host
    |--------------------------------------------------------------------------
    |
    | Set the host to scrape metrics from.
    |
    */

    'host' => env('METRICS_HOST', 'http://localhost:9601'),

];

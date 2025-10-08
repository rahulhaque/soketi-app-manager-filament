<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Trusted Proxy
    |--------------------------------------------------------------------------
    |
    | Here you may define proxy IPs for Laravel to trust. Set this if you're
    | behind a proxy server like Traefik. Requests from untrusted IPs will
    | not be accepted by Laravel and $request->ip() will show docker IP.
    |
    */

    'proxies' => env('TRUSTED_PROXY', null),

];

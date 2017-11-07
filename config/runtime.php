<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Error tracker id
    |--------------------------------------------------------------------------
    |
    | This is a random string generated for track log.
    |
    */

    'track' => base_convert(round(microtime(true) * 1000), 10, 32).'-'.bin2hex(openssl_random_pseudo_bytes(2)),

];

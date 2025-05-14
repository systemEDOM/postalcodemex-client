<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PostalCodeMex Key
    |--------------------------------------------------------------------------
    |
    | The PostalCodeMex publishable key give you access to PostalCodeMex
    | API. The "publishable" key is typically used when interacting with
    | PostalCodeMex and gives you access to private API endpoints.
    |
    */
    'base_url' => env('POSTALCODEMEX_BASE_URL', 'https://postalcodemex.omsoft.com.mx/api/v1'),
    'api_key' => env('POSTALCODEMEX_API_TOKEN'),
];

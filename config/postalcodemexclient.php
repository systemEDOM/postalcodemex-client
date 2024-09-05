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
    'base_url' => env('POSTAL_CODE_MEX_BASE_URL', 'http://postalcodemex.omsoft.com.mx/api/v1'),
    'api_key' => env('POSTAL_CODE_MEX_API_KEY'),
];

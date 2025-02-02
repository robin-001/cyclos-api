<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cyclos API Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can configure your Cyclos API settings. These values will be used
    | when connecting to your Cyclos instance.
    |
    */

    'api_url' => env('CYCLOS_API_URL', 'http://test.api.cyclos'),
    'api_key' => env('CYCLOS_API_KEY', 'test-api-key'),
];

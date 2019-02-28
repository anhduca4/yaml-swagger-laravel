<?php

return [
    'version' => [
        'v1' => [
            'name'  => 'Yaml swagger v1',
            'path'  => base_path('documents/swagger_v1'),
        ],
    ],
    'paths' => [
        /*
        |--------------------------------------------------------------------------
        | Absolute path to directory where to export views
        |--------------------------------------------------------------------------
        */
        'views' => base_path('resources/views/vendor/swagger'),
    ],
    'routes' => [
        /*
        |--------------------------------------------------------------------------
        | Route for accessing web documentation interface
        |--------------------------------------------------------------------------
        */
        'web' => 'swagger',
        /*
        |--------------------------------------------------------------------------
        | Route for accessing parsed swagger annotations.
        |--------------------------------------------------------------------------
        */
        'docs' => 'swagger-json',
        /*
        |--------------------------------------------------------------------------
        | Route for Oauth2 authentication callback.
        |--------------------------------------------------------------------------
        */
        'oauth2_callback' => 'api/oauth2-callback',
        /*
        |--------------------------------------------------------------------------
        | Middleware allows to prevent unexpected access to API documentation
        |--------------------------------------------------------------------------
         */
        'middleware' => [
            'index'           => [],
            'asset'           => [],
            'docs'            => [],
            'oauth2_callback' => [],
        ],
    ],
    'auth' => [
        // [
        // 'username' => 'anhduca4',
        // 'password' => '$2y$10$BhLzXt4my8.i0VLkvX8zzugpXl9UO8oU/GX3GtyNyn9vXXCFJuhPC',// app('hash')->make('password');
        // ],
    ],
];

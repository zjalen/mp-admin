<?php

return [
    /*
    |--------------------------------------------------------------------------
    | mp-admin install directory
    |--------------------------------------------------------------------------
    |
    | The installation directory of the controller and routing configuration
    | files of the administration page. The default is `app/Admin`, which must
    | be set before running `artisan admin::install` to take effect.
    |
    */
    'directory' => app_path('MpAdmin'),

    /*
    |--------------------------------------------------------------------------
    | mp-admin route settings
    |--------------------------------------------------------------------------
    |
    | The routing configuration of the mp-admin page, including the path prefix,
    | the controller namespace, and the default middleware. If you want to
    | access through the root path, just set the prefix to empty string.
    |
    */
    'route' => [

        'prefix' => env('ADMIN_ROUTE_PREFIX', 'mp-admin'),

        'namespace' => 'App\\MpAdmin\\Controllers',

        'middleware' => ['web', 'mp-admin'],
    ],
];
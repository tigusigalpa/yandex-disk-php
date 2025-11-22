<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Yandex Disk Access Token
    |--------------------------------------------------------------------------
    |
    | Your Yandex Disk OAuth access token. You can obtain it from:
    | https://oauth.yandex.ru/
    |
    */
    'access_token' => env('YANDEX_DISK_ACCESS_TOKEN', ''),

    /*
    |--------------------------------------------------------------------------
    | Default Upload Settings
    |--------------------------------------------------------------------------
    |
    | Default settings for file uploads
    |
    */
    'upload' => [
        'overwrite' => env('YANDEX_DISK_UPLOAD_OVERWRITE', true),
        'timeout' => env('YANDEX_DISK_UPLOAD_TIMEOUT', 60),
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Download Settings
    |--------------------------------------------------------------------------
    |
    | Default settings for file downloads
    |
    */
    'download' => [
        'timeout' => env('YANDEX_DISK_DOWNLOAD_TIMEOUT', 60),
    ],
];

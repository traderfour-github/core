<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

//    'default' => env('FILESYSTEM_DISK', 's3'),
    'default' =>  's3',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

//        's3' => [
//            'driver' => 's3',
//            'key' => env('AWS_ACCESS_KEY_ID', 'DO00QNH8XPWKQ8LACPYH'),
//            'secret' => env('AWS_SECRET_ACCESS_KEY', '8fW6lccpP19IjpTRCxS7AENWuhiz6/768ftZ7KDfyws	'),
//            'region' => env('AWS_DEFAULT_REGION', 'eu-central-1'),
//            'bucket' => env('AWS_BUCKET', 't4'),
//            'url' => env('AWS_URL', 'https://s.trader4.net'),
//            'endpoint' => env('AWS_ENDPOINT', 'https://traderfour.fra1.digitaloceanspaces.com'),
//            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
//            'throw' => false,
//        ],
        's3' => [
            'driver' => 's3',
            'key' =>  'DO00QNH8XPWKQ8LACPYH',
            'secret' =>  '8fW6lccpP19IjpTRCxS7AENWuhiz6/768ftZ7KDfyws',
            'region' => 'eu-central-1',
            'bucket' => 't4',
            'url' =>  'https://s.trader4.net',
            'endpoint' => 'https://traderfour.fra1.digitaloceanspaces.com',
            'use_path_style_endpoint' => false,
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];

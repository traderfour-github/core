<?php

return [
    'prefix' => [
        'micro' => 't4',
        'full' => 'Trader4'
    ],
    'qr' => [
        'expire_time' => 3,
    ],
    'pre_key' => 'tr4',
    'sms' =>[
        'expired_at' => 3 // Minutes to expire to token
    ],
    'temporary_url' => 15, // Minutes to expire to temporary url
    'kafka' => [
        'brokers' => env('KAFKA_BROKERS', 'localhost:9092'),
        'topics' => [
            'test' => [],
            'bridge' => env('KAFKA_TOPIC', 'commands')
        ],
    ],
    'path' => [
        'general' => 'general/',
        'usercontents' => 'usercontents/',
    ],
    'attachments' => [
        'max_size' => 1024 * 10, // KB
    ],
    'posts' => [
        'disk' => 's3',
        'path' => 'posts/',
    ],
    'estimated' => [
        'avg_time_per_word' => 0.3,
    ]
];

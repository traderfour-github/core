<?php

return [
    'attachments' => [
        'active' => true,
        'db_connection' => env('DB_CONNECTION'),
        'user_id_type' => 'uuid', // uuid or id
        'max_file_size' => 1024 * 10, // KB
        'temporary_url_ttl' => 15, // Minutes
    ],
];

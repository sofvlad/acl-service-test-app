<?php

return [
    'className'        => \Cake\Database\Connection::class,
    'driver'           => env('DB_ADAPTER'),
    'host'             => env('DB_HOST', 'localhost'),
    'database'         => env('DB_DATABASE'),
    'username'         => env('DB_USERNAME', 'root'),
    'password'         => env('DB_PASSWORD'),
    'encoding'         => env('DB_ENCODING', 'utf8'),
    'timezone'         => env('APP_TIMEZONE', 'UTC'),
    'cacheMetadata'    => true,
    'quoteIdentifiers' => false,
];

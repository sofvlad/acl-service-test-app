<?php

require __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap' . DIRECTORY_SEPARATOR . 'core.php';

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => env('PROD_DB_ADAPTER'),
            'host'    => env('PROD_DB_HOST', 'localhost'),
            'port'    => env('PROD_DB_PORT'),
            'name'    => env('PROD_DB_DATABASE'),
            'user'    => env('PROD_DB_USERNAME', 'root'),
            'pass'    => env('PROD_DB_PASSWORD'),
            'charset' => env('PROD_DB_ENCODING', 'utf8'),
        ],
        'development' => [
            'adapter' => env('DB_ADAPTER'),
            'host'    => env('DB_HOST', 'localhost'),
            'port'    => env('DB_PORT'),
            'name'    => env('DB_DATABASE'),
            'user'    => env('DB_USERNAME', 'root'),
            'pass'    => env('DB_PASSWORD'),
            'charset' => env('DB_ENCODING', 'utf8'),
        ],
        'testing' => [
            'adapter' => env('TEST_DB_ADAPTER'),
            'host'    => env('TEST_DB_HOST', 'localhost'),
            'port'    => env('TEST_DB_PORT'),
            'name'    => env('TEST_DB_DATABASE'),
            'user'    => env('TEST_DB_USERNAME', 'root'),
            'pass'    => env('TEST_DB_PASSWORD'),
            'charset' => env('TEST_DB_ENCODING', 'utf8'),
        ]
    ],
    'version_order' => 'creation'
];

<?php

return [
    'default' => [
        'className' => 'File',
        'prefix' => 'app_',
        'path' => DIR_CACHE,
    ],
    '_cake_core_' => [
        'className' => 'File',
        'prefix' => 'app_cake_core_',
        'path' => DIR_CACHE . 'core' . DS,
        'serialize' => true,
        'duration' => '+2 minutes',
    ],
    '_cake_model_' => [
        'className' => 'File',
        'prefix' => 'app_cake_model_',
        'path' => DIR_CACHE . 'models' . DS,
        'serialize' => true,
        'duration' => '+2 minutes',
    ],
];

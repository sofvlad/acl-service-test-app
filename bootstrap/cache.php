<?php
declare(strict_types=1);

if (!defined('DIR_CACHE')) {
    define('DIR_CACHE', DIR_VAR . 'cache' . DS);
}

foreach (require DIR_CONFIG . 'cache.php' as $key => $config) {
    \Cake\Cache\Cache::setConfig($key, $config);
}

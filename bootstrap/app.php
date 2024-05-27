<?php
declare(strict_types=1);

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('DIR_CONFIG')) {
    define('DIR_CONFIG', dirname(__DIR__, 1) . DS . 'config' . DS);
}

if (!defined('DIR_VAR')) {
    define('DIR_VAR', dirname(__DIR__, 1) . DS . 'var' . DS);
}

require __DIR__ . DS . 'core.php';
require __DIR__ . DS . 'di.php';
require __DIR__ . DS . 'database.php';
require __DIR__ . DS . 'cache.php';
require __DIR__ . DS . 'router.php';

$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();
$response = $router->dispatch($request);
$container->get(\HttpSoft\Emitter\EmitterInterface::class)->emit($response);

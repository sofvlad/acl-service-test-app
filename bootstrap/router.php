<?php
declare(strict_types=1);

$strategy = $container->get(\League\Route\Strategy\JsonStrategy::class)->setContainer($container);
$router = $container->get(\League\Route\Router::class)->setStrategy($strategy);
require_once dirname(__DIR__, 1) . DS . 'config' . DS . 'routes.php';

<?php
declare(strict_types=1);

$container = new League\Container\Container;

// Interfaces
$container->add(\Psr\Http\Message\RequestFactoryInterface::class, \GuzzleHttp\Psr7\HttpFactory::class);
$container->add(\Psr\Http\Message\ResponseFactoryInterface::class, \GuzzleHttp\Psr7\HttpFactory::class);
$container->add(\Psr\Http\Message\ServerRequestFactoryInterface::class, \GuzzleHttp\Psr7\HttpFactory::class);
$container->add(\Psr\Http\Message\StreamFactoryInterface::class, \GuzzleHttp\Psr7\HttpFactory::class);
$container->add(\Psr\Http\Message\UploadedFileFactoryInterface::class, \GuzzleHttp\Psr7\HttpFactory::class);
$container->add(\Psr\Http\Message\UriFactoryInterface::class, \GuzzleHttp\Psr7\HttpFactory::class);
$container->add(\HttpSoft\Emitter\EmitterInterface::class, \HttpSoft\Emitter\SapiEmitter::class);

// Middlewares
//$container->add(\App\Middleware\JsonMiddleware::class);
//$container->add(\App\Middleware\OpenAPIMiddleware::class);

$container->delegate(
    new League\Container\ReflectionContainer()
);

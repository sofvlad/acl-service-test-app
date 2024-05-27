<?php
declare(strict_types=1);

namespace App\Middleware;

use League\OpenAPIValidation\PSR7\ValidatorBuilder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class OpenAPIMiddleware implements MiddlewareInterface
{
    public function __construct(private ValidatorBuilder $validatorBuilder)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $validator = $this->validatorBuilder->fromYamlFile(DIR_CONFIG . 'api' . DS . 'schema.yaml');
        $validator->getRequestValidator()->validate($request);

        return $handler->handle($request);
    }
}

<?php
declare(strict_types=1);

namespace App\Middleware;

use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class JsonMiddleware implements MiddlewareInterface
{
    public function __construct(private HttpFactory $httpFactory)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            if ($request->getHeaderLine('Content-Type') != 'application/json') {
                return $handler->handle($request);
            }

            if ($request->getBody()->getSize()) {
                $body = json_decode((string)$request->getBody(), true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \Exception(json_last_error_msg());
                }
                $request = $request->withParsedBody($body);
            }

            return $handler->handle($request);
        } catch (\Throwable $e) {
            $response = $this->httpFactory->createResponse()->withHeader('Content-type', 'application/json');
            $response->getBody()->write(json_encode(['success' => false, 'message' => $e->getMessage()]));
            $response->withStatus(500);

            return $response;
        }
    }
}

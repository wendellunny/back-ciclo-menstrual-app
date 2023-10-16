<?php

namespace CicloMenstrual\Infrastructure\Middlewares;

use CicloMenstrual\Infrastructure\Api\Middlewares\MiddlewareInterface;
use CicloMenstrual\Infrastructure\Gateways\Jwt;
use DateTimeImmutable;
use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\Request;

class JwtMiddleware implements MiddlewareInterface
{
    public function __construct(private Jwt $jwt, private RequestInterface $request)
    {
        
    }

    public function handle(RequestInterface $request): void
    {
        if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(['message' => 'Token not found in request']);
            exit;
        }

        $jwt = $matches[1];
        if (! $jwt) {
            // No token was able to be extracted from the authorization header
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(['message' => 'Token not found in request']);
            exit;
        }
        $token = $this->jwt->decode($jwt);
        $now = new DateTimeImmutable();
        $serverName = $this->request->getHeader('host')[0];
        

        if ($token->iss !== $serverName ||
            $token->nbf > $now->getTimestamp() ||
            $token->exp < $now->getTimestamp())
        {
            header('HTTP/1.1 401 Unauthorized');
            exit;
        }
    }
}
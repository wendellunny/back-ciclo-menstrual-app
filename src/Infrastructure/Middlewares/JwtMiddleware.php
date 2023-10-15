<?php

namespace CicloMenstrual\Infrastructure\Middlewares;

use CicloMenstrual\Infrastructure\Api\Middlewares\MiddlewareInterface;
use CicloMenstrual\Infrastructure\Gateways\Jwt;
use DateTimeImmutable;
use Psr\Http\Message\RequestInterface;

class JwtMiddleware implements MiddlewareInterface
{
    public function __construct(private Jwt $jwt)
    {
        
    }

    public function handle(RequestInterface $request): void
    {
        if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
            header('HTTP/1.0 400 Bad Request');
            echo 'Token not found in request';
            exit;
        }

        $jwt = $matches[1];
        if (! $jwt) {
            // No token was able to be extracted from the authorization header
            header('HTTP/1.0 400 Bad Request');
            exit;
        }
        $token = $this->jwt->decode($jwt);
        $now = new DateTimeImmutable();
        $serverName = "127.0.0.1";

        if ($token->iss !== $serverName ||
            $token->nbf > $now->getTimestamp() ||
            $token->exp < $now->getTimestamp())
        {
            header('HTTP/1.1 401 Unauthorized');
            exit;
        }
    }
}
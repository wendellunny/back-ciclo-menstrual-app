<?php

namespace CicloMenstrual\Infrastructure\Middlewares;

use CicloMenstrual\Infrastructure\Services\Jwt\JwtEncoderInterface;
use DateTimeImmutable;
use Psr\Http\Message\RequestInterface;

/**
 * Jwt middleware
 */
class JwtMiddleware implements MiddlewareInterface
{
    /**
     * Constructor method
     *
     * @param JwtEncoderInterface $jwt
     * @param RequestInterface $request
     */
    public function __construct(private JwtEncoderInterface $jwt, private RequestInterface $request)
    {
    }

    /**
     * Handle
     *
     * @return void
     */
    public function handle(): void
    {
        $token = $this->getToken();
        $this->validateToken($token);
    }

    /**
     * Get token
     *
     * @return string
     */
    private function getToken(): string
    {
        if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(['message' => 'Token not found in request']);
            exit;
        }

        return $matches[1];
    }

    /**
     * Validate token
     *
     * @param string $token
     * @return void
     */
    private function validateToken(string $token)
    {
        if (! $token) {
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(['message' => 'Token not found in request']);
            exit;
        }
        $token = $this->jwt->decode($token);
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
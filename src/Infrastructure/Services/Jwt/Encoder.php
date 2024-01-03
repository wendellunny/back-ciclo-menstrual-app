<?php

namespace CicloMenstrual\Infrastructure\Services\Jwt;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Encoder implements JwtEncoderInterface
{
    /**
     * Encode
     *
     * @param array $payload
     * @return string
     */
    public function encode(array $payload): string
    {
        return JWT::encode($payload, $_ENV['JWT_KEY'], 'HS256');
    }

   
    /**
     * Decode
     *
     * @param string $token
     * @return stdClass
     */
    public function decode(string $token): stdClass
    {
        return JWT::decode($token, new Key($_ENV['JWT_KEY'], 'HS256'))
    }
}
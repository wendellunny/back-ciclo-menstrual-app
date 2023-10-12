<?php

namespace CicloMenstrual\Infrastructure\Gateways;

use Firebase\JWT\JWT as JWTJWT;
use Firebase\JWT\Key;
use stdClass;

class Jwt
{
    public const KEY = 'minha-chave';


    public function encode(array $payload): string
    {
        $payload = array_merge(
            $payload
        );
        return JWTJWT::encode($payload, static::KEY, 'HS256');
    }

    public function decode(string $jwtKey): stdClass
    {
        return JWTJWT::decode($jwtKey, new Key(static::KEY, 'HS256'));
    }
}
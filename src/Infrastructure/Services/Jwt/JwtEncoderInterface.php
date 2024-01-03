<?php

namespace CicloMenstrual\Infrastructure\Services\Jwt;

use stdClass;

interface JwtEncoderInterface
{
    /**
     * Encode
     *
     * @param array $payload
     * @return string
     */
    public function encode(array $payload): string;

   
    /**
     * Decode
     *
     * @param string $token
     * @return stdClass
     */
    public function decode(string $token): stdClass;
} 
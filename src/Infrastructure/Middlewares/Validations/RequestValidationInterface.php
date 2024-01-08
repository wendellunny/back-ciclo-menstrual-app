<?php

namespace CicloMenstrual\Infrastructure\Middlewares\Validations;

use CicloCmenstrual\Infrastructure\Middlewares\Validations\Errors;
use Psr\Http\Message\RequestInterface;

interface RequestValidationInterface
{
    public function validate(RequestInterface $request): Errors;
}
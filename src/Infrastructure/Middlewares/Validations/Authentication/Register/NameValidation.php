<?php

namespace CicloMenstrual\Infrastructure\Middlewares\Validations\Authentication\Register;

use CicloCmenstrual\Infrastructure\Middlewares\Validations\Errors;
use CicloMenstrual\Infrastructure\Middlewares\Validations\RequestValidationInterface;
use Psr\Http\Message\RequestInterface;

class NameValidation implements RequestValidationInterface
{
    public function validate(RequestInterface $request): Errors
    {
        $errors = [];
        $body   = json_decode($request->getBody()->getContents());

        if(!$body->name || $body->name < 3)
        {
            $errors[] = 'Invalid name';
        }
        
        return new Errors($errors);
    }
}
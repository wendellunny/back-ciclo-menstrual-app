<?php

namespace CicloMenstrual\Infrastructure\Middlewares\Validations\Authentication\Register;

use CicloCmenstrual\Infrastructure\Middlewares\Validations\Errors;
use CicloMenstrual\Infrastructure\Middlewares\Validations\RequestValidationInterface;
use CicloMenstrual\Infrastructure\Services\Request\Trait\HasRequestFormatter;
use Psr\Http\Message\RequestInterface;

class NameValidation implements RequestValidationInterface
{
    use HasRequestFormatter;
    
    public function validate(RequestInterface $request): Errors
    {
        $errors = [];
        $body   = $this->getBody($request);

        if(!$body->name || $body->name < 3)
        {
            $errors[] = 'Invalid name';
        }
        
        return new Errors($errors);
    }
}
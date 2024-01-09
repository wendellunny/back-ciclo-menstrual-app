<?php

namespace CicloMenstrual\Infrastructure\Middlewares\Validations\Authentication\Register;

use CicloCmenstrual\Infrastructure\Middlewares\Validations\Errors;
use CicloMenstrual\Infrastructure\Middlewares\Validations\RequestValidationInterface;
use CicloMenstrual\Infrastructure\Services\Request\Trait\HasRequestFormatter;
use Psr\Http\Message\RequestInterface;

class BirthDateValidation implements RequestValidationInterface
{
    use HasRequestFormatter;

    public function validate(RequestInterface $request): Errors
    {
        $errors = [];
        $body   = $this->getBody($request);

        if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $body->birth_date))
        {
            $errors[] = 'Invalid date format';
        }
        
        return new Errors($errors);
    }
}
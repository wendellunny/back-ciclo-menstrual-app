<?php

namespace CicloMenstrual\Infrastructure\Middlewares\Validation;

use CicloCmenstrual\Infrastructure\Middlewares\Validations\Errors;
use CicloMenstrual\Infrastructure\Middlewares\Validations\RequestValidationInterface;
use Exception;
use Psr\Http\Message\RequestInterface;

class ValidationComposite implements RequestValidationInterface
{
    public function __construct(private array $authValidations)
    {
    }

    public function validate(RequestInterface $request): Errors
    {
        $errors = [];

        foreach ($this->authValidations as $validation) {
            /**
             * @var RequestValidationInterface $validation
             */
            if(!$validation instanceof RequestValidationInterface) {
                throw new Exception("Validation must implemens" . RequestValidationInterface::class);
            }

            $errors = array_merge($errors, $validation->validate($request)->getErrors());
        }

        return new Errors($errors);
    }
}
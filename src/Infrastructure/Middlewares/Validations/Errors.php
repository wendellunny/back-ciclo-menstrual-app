<?php

namespace CicloCmenstrual\Infrastructure\Middlewares\Validations;

class Errors
{
    public function __construct(private array $errors = [])
    {
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return (bool)count($this->errors) > 0;
    }
}
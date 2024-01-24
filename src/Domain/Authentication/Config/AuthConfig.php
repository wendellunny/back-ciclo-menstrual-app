<?php

namespace CicloMenstrual\Domain\Authentication\Config;


class AuthConfig implements AuthConfigInterface 
{
    public function getEncryptKey(): string
    {
        return '';
    }

    public function getEncryptAlgorithm(): string
    {
        return '';
    }
}
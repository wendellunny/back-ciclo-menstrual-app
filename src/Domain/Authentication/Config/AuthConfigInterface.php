<?php

namespace CicloMenstrual\Domain\Authentication\Config;

interface AuthConfigInterface
{
    public function getEncryptKey(): string;

    public function getEncryptAlgorithm(): string;
}
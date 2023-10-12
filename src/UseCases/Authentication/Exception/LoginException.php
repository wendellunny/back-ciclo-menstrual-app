<?php

namespace CicloMenstrual\UseCases\Authentication\Exception;

class LoginException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Login ou senha incorretos', 403);
    }
}
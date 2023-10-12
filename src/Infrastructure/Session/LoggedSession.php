<?php

namespace CicloMenstrual\Infrastructure\Session;

use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;
use CicloMenstrual\UseCases\Api\Authentication\Session\LoggedSessionInterface;

class LoggedSession implements LoggedSessionInterface
{
    public function __construct(private UserInterface $user, private string $token)
    {
        
    }
    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * Authorization token
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}
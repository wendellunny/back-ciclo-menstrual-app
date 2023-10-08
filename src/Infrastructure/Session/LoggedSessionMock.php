<?php

namespace CicloMenstrual\Infrastructure\Session;

use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;
use CicloMenstrual\UseCases\Api\Authentication\Session\LoggedSessionInterface;

class LoggedSessionMock implements LoggedSessionInterface
{
    public function __construct(private UserInterface $user)
    {
        
    }
    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user
            ->setUuid('uuid-mockado')
            ->setName('wendel');   
    }
}
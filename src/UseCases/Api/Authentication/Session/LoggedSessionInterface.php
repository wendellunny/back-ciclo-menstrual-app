<?php

namespace CicloMenstrual\UseCases\Api\Authentication\Session;

use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;

interface LoggedSessionInterface
{
    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser(): UserInterface;
}
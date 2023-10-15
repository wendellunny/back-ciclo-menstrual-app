<?php

namespace CicloMenstrual\UseCases\Api\Authentication;

use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;

interface LoginInterface
{
    /**
     * Authenticate
     *
     * @param UserInterface $user
     * @return string|false
     */
    public function authenticate(UserInterface $user): string|false;
}
<?php

namespace CicloMenstrual\Usecases\Api\Authentication;

use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;

interface LoginInterface
{
    /**
     * Authenticate
     *
     * @param UserInterface $user
     * @return void
     */
    public function authenticate(UserInterface $user): void;
}
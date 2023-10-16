<?php

namespace CicloMenstrual\UseCases\Authentication;

use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;
use CicloMenstrual\UseCases\Api\Authentication\UserRepositoryInterface;

class Registration
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
        
    }

    public function register(UserInterface $user): bool
    {
        return $this->userRepository->insert($user);
    }
}
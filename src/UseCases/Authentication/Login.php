<?php

namespace CicloMenstrual\UseCases\Authetication;

use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;
use CicloMenstrual\Usecases\Api\Authentication\LoginInterface;
use CicloMenstrual\Usecases\Api\Authentication\UserRepositoryInterface;
use CicloMenstrual\UseCases\Authetication\Exception\LoginException;

class Login implements LoginInterface
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
        
    }
    /**
     * Authenticate
     *
     * @param UserInterface $user
     * @return void
     */
    public function authenticate(UserInterface $user): void
    {
        $userSaved = $this->userRepository->loadByEmail($user->getEmail());

        $passwordVerification = password_verify(
            $user->getPassword(),
            $userSaved ? $userSaved->getPassword() : ''
        );

        if(!$userSaved || !$passwordVerification)
        {
            throw new LoginException();
        }

        // return false;
    }
}
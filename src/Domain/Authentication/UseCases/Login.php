<?php

namespace CicloMenstrual\Domain\Authentication\UseCases;

use CicloMenstrual\Domain\Authentication\Config\AuthConfigInterface;
use CicloMenstrual\Domain\Authentication\Entities\Dtos\LoginData;
use CicloMenstrual\Domain\Authentication\Entities\User;
use CicloMenstrual\Domain\Authentication\Repositories\UserRepositoryInterface;

/**
 * Login use case
 */
class Login
{

    /**
     * Constructor method
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(private UserRepositoryInterface $repository, private AuthConfigInterface $config)
    {
    }

    /**
     * Authenticate
     *
     * @param LoginData $loginData
     * @return User|false
     */
    public function authenticate(LoginData $loginData): User|false
    {
        $storedPassword = $this->generateFakePassword();
        $user = $this->repository->findByEmail($loginData->getEmail());

        if ($user) {
            $storedPassword = $user->getPassword();
        }

        $password = $user ? $this->getPasswordSalt($user, $loginData) : $loginData->getPassword();

        return $this->verifyPassword($storedPassword, $password) && ($user !== null) 
            ? $user
            : false;
    }

    /**
     * Genereate Fake Password
     *
     * @return string
     */
    private function generateFakePassword(): string
    {
        $length = 7;
        return substr(
            str_shuffle(
                str_repeat(
                    $x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
                    ceil($length/strlen($x))
                )
            ),
            1,$length
        );
    }

    private function getPasswordSalt(User $user, LoginData $loginData): string
    {
        return "{$user->getUuid()}_{$loginData->getPassword()}";
    }

    /**
     * Verify Password
     *
     * @param string $storedPassword
     * @param string $password
     * @return boolean
     */
    private function verifyPassword(string $storedPassword, string $password): bool
    {
        $decrypted = openssl_decrypt(
            $storedPassword,
            $this->config->getEncryptAlgorithm(),
            $this->config->getEncryptKey()
        );

        return password_verify($password, $decrypted);
    }
}
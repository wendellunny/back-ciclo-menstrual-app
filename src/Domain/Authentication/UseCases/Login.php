<?php

namespace CicloMenstrual\Domain\Authentication\UseCases;

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
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * Authenticate
     *
     * @param LoginData $loginData
     * @return bool
     */
    public function authenticate(LoginData $loginData): bool
    {
        $storedPassword = $this->generateFakePassword();
        $user = $this->repository->findByEmail($loginData->getEmail());

        if ($user) {
            $storedPassword = $user->getPassword();
        }

        $password = $user ? $this->getPasswordSalt($user, $loginData) : $loginData->getPassword();
        
        return $this->verifyPassword($storedPassword, $password)
            && ($user !== null);
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
        /**
         * TODO criar interface para o configurador
         */
        $decrypted = openssl_decrypt($password, 'AES-256-CBC', $_ENV['APP_ENCRYPT_KEY']);
        
        return password_verify($storedPassword, $decrypted);
    }
}
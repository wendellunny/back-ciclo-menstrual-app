<?php

namespace CicloMenstrual\Infrastructure\Repositories;

use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;
use CicloMenstrual\UseCases\Api\Authentication\UserRepositoryInterface;
use CicloMenstrual\UseCases\Authentication\Data\User;

class UserRepositoryMock implements UserRepositoryInterface
{
    /**
     * Load user by uuid
     *
     * @param string $uuid
     * @return UserInterface|false
     */
    public function loadByUuid(string $uuid): UserInterface|false
    {
        $password =  "{$uuid}_minhasenha";
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $crypt = openssl_encrypt($hash, 'AES-256-CBC', 'minha chave');
        
        $user = new User();
        return $user->setUuid($uuid)
            ->setName('Wendel')
            ->setPassword($crypt)
            ->setEmail('wendel@teste.com');

    }

    /**
     * Load user by email
     *
     * @param string $email
     * @return UserInterface|false
     */
    public function loadByEmail(string $email): UserInterface|false
    {
    
        if ($email != 'wendel@teste.com') {
            return false;
        }

        $uuid = 'uuid';
        $password =  "{$uuid}_minhasenha";
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $crypt = openssl_encrypt($hash, 'AES-256-CBC', $_ENV['APP_ENCRYPT_KEY']);
        
        $user = new User();
        return $user->setUuid($uuid)
            ->setName('Wendel')
            ->setPassword($crypt)
            ->setEmail($email);
    }
}
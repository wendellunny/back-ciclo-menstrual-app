<?php

namespace CicloMenstrual\Domain\Authentication\UserCases;

use CicloMenstrual\Domain\Authentication\Entities\Dtos\RegisterData;
use CicloMenstrual\Domain\Authentication\Entities\User;
use CicloMenstrual\Domain\Authentication\Repositories\UserRepositoryInterface;

/**
 * Register use case
 */
class Register
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
     * Execute
     *
     * @param RegisterData $registerData
     * @return void
     */
    public function execute(RegisterData $registerData): void
    {
        $user = new User();
        $uuid = uniqid();
        $user->setName($registerData->getName())
            ->setEmail($registerData->getEmail())
            ->setBirthDate($registerData->getBirthDate())
            ->setPassword(
                $this->makePasswordHash(
                    $registerData->getPassword(),
                    $uuid
                )
            )
            ->setUuid($uuid);

        $this->repository->save($user);
    }

    private function makePasswordHash(string $password, string $uuid): string
    {
        $passwordSalt = "{$uuid}_{$password}";
        return openssl_encrypt($passwordSalt, 'AES-256-CBC', $_ENV['APP_ENCRYPT_KEY']);
    }
}
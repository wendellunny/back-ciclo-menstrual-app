<?php

namespace CicloMenstrual\Domain\Authentication\UseCases;

use CicloMenstrual\Domain\Authentication\Config\AuthConfigInterface;
use CicloMenstrual\Domain\Authentication\Entities\Dtos\RegisterData;
use CicloMenstrual\Domain\Authentication\Entities\Factories\UserFactory;
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
     * @param UserRepositoryInterface   $repository
     * @param AuthConfigInterface       $config
     * @param UserFactory               $factory
     */
    public function __construct(
        private UserRepositoryInterface $repository,
        private AuthConfigInterface     $config,
        private UserFactory             $factory
    ) {
    }

    /**
     * Execute
     *
     * @param RegisterData $registerData
     * @return void
     */
    public function execute(RegisterData $registerData): void
    {
        /**
         * @var User $user
         */
        $user = $this->factory->create();

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

    /**
     * Make password hash
     *
     * @param string $password
     * @param string $uuid
     * @return string
     */
    private function makePasswordHash(string $password, string $uuid): string
    {
        $passwordSalt = "{$uuid}_{$password}";
        $hash = password_hash($passwordSalt, PASSWORD_BCRYPT);

        return openssl_encrypt($hash, $this->config->getEncryptAlgorithm(), $this->config->getEncryptKey());
    }
}
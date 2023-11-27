<?php

namespace CicloMenstrual\Domain\Authentication\Repositories;

use CicloMenstrual\Domain\Authentication\Entities\User;

/**
 * User repository interface
 */
interface UserRepositoryInterface
{
    /**
     * Find user by email
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;

    /**
     * Save user
     *
     * @param User $user
     * @return boolean
     */
    public function save(User $user): bool;
}
<?php

namespace CicloMenstrual\UseCases\Api\Authentication;

use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;

interface UserRepositoryInterface
{
    /**
     * Load user by uuid
     *
     * @param string $uuid
     * @return UserInterface|false
     */
    public function loadByUuid(string $uuid): UserInterface|false;

    /**
     * Load user by email
     *
     * @param string $email
     * @return UserInterface|false
     */
    public function loadByEmail(string $email): UserInterface|false;

    /**
     * Insert user in database
     *
     * @return boolean
     */
    public function insert(UserInterface $user): bool;
}
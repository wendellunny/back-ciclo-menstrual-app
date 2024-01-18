<?php

namespace CicloMenstrual\Infrastructure\Repositories;

use CicloMenstrual\Domain\Authentication\Entities\User;
use CicloMenstrual\Domain\Authentication\Repositories\UserRepositoryInterface;
use CicloMenstrual\Infrastructure\Services\PostgreSQL\Connection;
use PDO;

class UserRepository implements UserRepositoryInterface
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Connection::get()->getDb();
    }
    
    /**
     * Find user by email
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return new User();
    }

    /**
     * Save user
     *
     * @param User $user
     * @return boolean
     */
    public function save(User $user): bool
    {
        $this->db->query()

        return true;
    }
}
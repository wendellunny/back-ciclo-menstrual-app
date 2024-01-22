<?php

namespace CicloMenstrual\Infrastructure\Repositories;

use CicloMenstrual\Domain\Authentication\Entities\User;
use CicloMenstrual\Domain\Authentication\Repositories\UserRepositoryInterface;
use CicloMenstrual\Infrastructure\Services\PostgreSQL\Connection;
use PDO;

/**
 * User repository
 */
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
        $statement = $this->db->prepare('SELECT FROM users WHERE email = :email');
        $statement->bindParam('email', $email);
        $statement->execute();

        $user = $statement->fetchAll()[0];

        return (new User())
            ->setName($user['name'])
            ->setBirthDate($user['birth_date'])
            ->setEmail($user['email'])
            ->setPassword($user['password']);
    }

    /**
     * Save user
     *
     * @param User $user
     * @return boolean
     */
    public function save(User $user): bool
    {
        $statement = $this->db->prepare(
            'INSERT INTO users (name, birth_date, email, password) VALUES (:name, :birth_date, :email, :password)'
        );

        return $statement->execute();
    }
}
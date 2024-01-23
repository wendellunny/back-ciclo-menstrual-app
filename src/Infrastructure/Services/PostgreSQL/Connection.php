<?php

namespace CicloMenstrual\Infrastructure\Services\PostgreSQL;

use CicloMenstrual\Infrastructure\Singleton;
use PDO;

class Connection extends Singleton
{

    private PDO $pdo;

    public function connect(): void
    {
        $connectionStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
                $_ENV['POSTGRES_HOST'],
                $_ENV['POSTGRES_PORT'],
                $_ENV['POSTGRES_DB'],
                $_ENV['POSTGRES_USER'],
                $_ENV['POSTGRES_PASSWORD']
            );

        $this->pdo = new PDO($connectionStr);
    }

    public function getDb(): PDO
    {
        return $this->pdo;
    }
}
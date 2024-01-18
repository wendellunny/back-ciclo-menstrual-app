<?php

namespace CicloMenstrual\Infrastructure\Providers;

use CicloMenstrual\Infrastructure\Services\PostgreSQL\Connection as PostgreConnection;

/**
 * Database service provider
 */
class DatabaseServiceProvider implements ProviderInterface
{
    /**
     * Handle provider
     *
     * @return void
     */
    public function handle(): void
    {
        PostgreConnection::get()->connect();
    }
}

<?php

namespace CicloMenstrual\Infrastructure\Providers;

/**
 * App service provider
 */
class AppServiceProvider implements ProviderInterface
{

    /**
     * Constructor method
     *
     * @param RouterServiceProvider $routerServiceProvider
     */
    public function __construct(
        private RouterServiceProvider $routerServiceProvider,
        private DatabaseServiceProvider $databaseServiceProvider,
    ) {
        
    }
    /**
     * Provider
     *
     * @return void
     */
    public function handle(): void
    {
        $this->databaseServiceProvider->handle();
        $this->routerServiceProvider->handle(); 
    }
}

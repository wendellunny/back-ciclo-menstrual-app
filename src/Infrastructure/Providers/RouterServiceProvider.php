<?php

namespace CicloMenstrual\Infrastructure\Providers;

use CicloMenstrual\Infrastructure\Services\Router\Router;

class RouterServiceProvider implements ProviderInterface
{
    
    public function __construct(private Router $router)
    {
        
    }
    /**
     * Provider
     *
     * @return void
     */
    public function handle(): void
    {
        $this->router
        ->configure(
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'routes' . 'api.php'
        )
        ->handle();
    }
}
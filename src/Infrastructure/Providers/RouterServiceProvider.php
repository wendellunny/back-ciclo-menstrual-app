<?php

namespace CicloMenstrual\Infrastructure\Providers;

use CicloMenstrual\Infrastructure\Services\Router\Router;

/**
 * Router service provider
 */
class RouterServiceProvider implements ProviderInterface
{
    /**
     * Constructor method
     *
     * @param Router $router
     */
    public function __construct(private Router $router)
    {
    }

    /**
     * Handle provider
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

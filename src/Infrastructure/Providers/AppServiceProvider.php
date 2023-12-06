<?php

namespace CicloMenstrual\Infrastructure\Providers;

class AppServiceProvider implements ProviderInterface
{

    public function __construct(private RouterServiceProvider $routerServiceProvider)
    {
        
    }
    /**
     * Provider
     *
     * @return void
     */
    public function handle(): void
    {
        $this->routerServiceProvider->handle();
    }
}
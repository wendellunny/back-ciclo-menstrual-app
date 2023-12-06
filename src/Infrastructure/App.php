<?php

namespace CicloMenstrual\Infrastructure;

use CicloMenstrual\Infrastructure\Providers\AppServiceProvider;
use Psr\Container\ContainerInterface;

class App
{
    public function __construct(private ContainerInterface $container)
    {
    }

    public function start(): void
    {
        /**
         * @var AppServiceProvider $provider
         */
        $provider = $this->container->get(AppServiceProvider::class);

        $provider->handle();
    }

}
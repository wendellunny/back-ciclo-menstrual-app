<?php

namespace CicloMenstrual\Infrastructure;

use CicloMenstrual\Infrastructure\Providers\AppServiceProvider;
use Psr\Container\ContainerInterface;

/**
 * App class
 */
class App
{
    /**
     * Constructor method
     *
     * @param ContainerInterface $container
     */
    public function __construct(private ContainerInterface $container)
    {
    }

    /**
     * Start
     *
     * @return void
     */
    public function start(): void
    {
        /**
         * @var AppServiceProvider $provider
         */
        $provider = $this->container->get(AppServiceProvider::class);

        $provider->handle();
    }
}

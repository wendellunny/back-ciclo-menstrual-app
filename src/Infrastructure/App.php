<?php

namespace CicloMenstrual\Infrastructure;

use CicloMenstrual\Infrastructure\Providers\AppServiceProvider;
use Psr\Container\ContainerInterface;
use Throwable;

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
        try {
            /**
             * @var AppServiceProvider $provider
             */
            $provider = $this->container->get(AppServiceProvider::class);

            $provider->handle();

        } catch(Throwable $e) {
            echo json_encode([
                'error' => $e->getMessage(),
                'file' => $e->getFile() . ":" . $e->getLine(),
                'code' => $e->getCode(),
                'trace' => $e->getTrace(),
            ]);
        }
        
    }
}

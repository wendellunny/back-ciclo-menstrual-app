<?php

namespace CicloMenstrual\Infrastructure\ServiceProviders;

use CicloMenstrual\Infrastructure\Api\Gateways\RouterGatewayInterface;
use Psr\Container\ContainerInterface;

class Router
{
    public function __construct(private RouterGatewayInterface $route, private ContainerInterface $container)
    {
    }

    public function handle(): void
    {
        require_once __DIR__
        . DIRECTORY_SEPARATOR . '..'
        . DIRECTORY_SEPARATOR . 'routes'
        . DIRECTORY_SEPARATOR . 'api.php';

        $this->route->match();
    }
}
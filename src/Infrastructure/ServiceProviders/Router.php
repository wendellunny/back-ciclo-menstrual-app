<?php

namespace CicloMenstrual\Infrastructure\ServiceProviders;

use CicloMenstrual\Infrastructure\Api\Gateways\RouterGatewayInterface;

class Router
{
    public function __construct(private RouterGatewayInterface $route)
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
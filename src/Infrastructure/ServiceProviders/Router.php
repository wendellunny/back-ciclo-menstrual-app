<?php

namespace CicloMenstrual\Infrastructure\ServiceProviders;

use Aura\Router\RouterContainer;
use CicloMenstrual\Infrastructure\Controllers\MenstrualPeriodController;
use CicloMenstrual\Infrastructure\Gateways\Route;
use CicloMenstrual\Infrastructure\Singleton;
use DI\Container;


class Router
{
    private Route $route;

    public function __construct(private Container $container, private RouterContainer $routerContainer)
    {
        $this->route = Route::getInstance();
        
        $this->route->init($this->routerContainer, $this->container);
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
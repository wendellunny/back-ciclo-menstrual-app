<?php

namespace CicloMenstrual\Infrastructure\Main;

use Aura\Router\RouterContainer;
use CicloMenstrual\Infrastructure\ServiceProviders\Router;
use CicloMenstrual\Infrastructure\Singleton;
use CicloMenstrual\UseCases\MenstrualCicle\Data\Period;
use CicloMenstrual\UseCases\MenstrualCicle\PeriodProcessor;
use DateInterval;
use DateTimeImmutable;
use DI\Container;
use DI\ContainerBuilder;

class App
{
    public function __construct(private Container $container)
    {
    }

    public function start(): void
    {
        $router = new Router($this->container);

        $router->handle();
    }
}
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
use Throwable;

class App
{
    public const DI_DEFINITIONS = __DIR__ .  DIRECTORY_SEPARATOR
        . '..' . DIRECTORY_SEPARATOR
        . '..' . DIRECTORY_SEPARATOR
        . '..' . DIRECTORY_SEPARATOR
        .'config' . DIRECTORY_SEPARATOR
        . 'di.php';

    public function start(): void
    {
        try{
            $containerBuilder = (new ContainerBuilder())->addDefinitions(static::DI_DEFINITIONS);
            $diContainer = $containerBuilder->build();
            $routerContainer = new RouterContainer();

            $router = new Router($diContainer, $routerContainer);

            $router->handle();
        }catch(Throwable $e){
            dd($e->getMessage(), $e->getTrace());
        }
        
    }
}
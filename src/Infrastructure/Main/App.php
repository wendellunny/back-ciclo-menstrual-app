<?php

namespace CicloMenstrual\Infrastructure\Main;

use Aura\Router\RouterContainer;
use CicloMenstrual\Infrastructure\ServiceProviders\Router;
use CicloMenstrual\Infrastructure\Singleton;
use CicloMenstrual\UseCases\Authentication\Exception\LoginException;
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
        . '*.php';

    public function start(): void
    {
        try{
            $files = glob(static::DI_DEFINITIONS);
            $containerBuilder = (new ContainerBuilder())->addDefinitions(...$files);
            $diContainer = $containerBuilder->build();
            $routerContainer = new RouterContainer();
            
            $router = new Router($diContainer, $routerContainer);

            $router->handle();
        }catch(Throwable $e){
            http_response_code($e->getCode());
            $error = [
                'message' => $e->getMessage(),
            ];

            if(!$e instanceof LoginException) {
                $error['trace'] = $e->getTrace();
            }
            echo json_encode($error);
        }
        
    }
}
<?php

namespace CicloMenstrual\Infrastructure\Main;

use Aura\Router\RouterContainer;
use CicloMenstrual\Infrastructure\ServiceProviders\Router;
use CicloMenstrual\UseCases\Authentication\Exception\LoginException;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Throwable;

trait AppTrait
{
    private function configure(string $diDefinitionsPath): void
    {
        $diContainer = $this->configureDiContainer($diDefinitionsPath);
        $this->configureRoutes($diContainer);
    }

    private function configureDiContainer(string $defintionsPath): ContainerInterface
    {
        $diConfigFiles = glob($defintionsPath);
        $containerBuilder = (new ContainerBuilder())->addDefinitions(...$diConfigFiles);

        return $containerBuilder->build();
    }

    private function configureRoutes(ContainerInterface $diContainer): void
    {
        $router = $diContainer->get(Router::class);

        $router->handle();
    }

    private function formatErrors(Throwable $throw): void
    {
        http_response_code($throw->getCode());
            $error = [
                'message' => $throw->getMessage(),
            ];

            if(!$throw instanceof LoginException) {
                $error['trace'] = $throw->getTrace();
            }
            echo json_encode($error);
    }
}

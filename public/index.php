<?php

use Aura\Router\RouterContainer;
use CicloMenstrual\Infrastructure\Gateways\Route;
use CicloMenstrual\Infrastructure\Main\App;
use DI\Container;
use DI\ContainerBuilder;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->useAttributes(true);
$containerBuilder->addDefinitions([
    Route::class => \DI\create(Route::class)->method('init', \DI\get(RouterContainer::class), \DI\get(Container::class))
]);
$diContainer = $containerBuilder->build();

$app = new App($diContainer);

$app->start();

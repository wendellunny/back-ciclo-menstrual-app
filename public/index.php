<?php

declare(strict_types=1);

use CicloMenstrual\Infrastructure\App;
use DI\ContainerBuilder;

require_once
    __DIR__     . DIRECTORY_SEPARATOR
    . '..'      . DIRECTORY_SEPARATOR
    . 'vendor'  . DIRECTORY_SEPARATOR
    . 'autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$dotenv->safeLoad();

$defintionsPath = __DIR__
    . DIRECTORY_SEPARATOR . '..'
    . DIRECTORY_SEPARATOR . 'config'
    . DIRECTORY_SEPARATOR . 'di'
    . DIRECTORY_SEPARATOR . '*.php';
    
$diConfigFiles = glob($defintionsPath);
$containerBuilder = (new ContainerBuilder())->addDefinitions(...$diConfigFiles);

$app = new App($containerBuilder->build());
$app->start();

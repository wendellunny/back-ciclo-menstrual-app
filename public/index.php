<?php

declare(strict_types=1);

use CicloMenstrual\Infrastructure\Main\App;

require_once
    __DIR__     . DIRECTORY_SEPARATOR
    . '..'      . DIRECTORY_SEPARATOR
    . 'vendor'  . DIRECTORY_SEPARATOR
    . 'autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$dotenv->safeLoad();

$app = new App();
$app->start();

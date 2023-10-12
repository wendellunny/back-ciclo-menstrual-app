<?php

// declare(strict_types=1);

use CicloMenstrual\Infrastructure\Main\App;


require_once __DIR__ . DIRECTORY_SEPARATOR
    . '..' . DIRECTORY_SEPARATOR
    . 'vendor' . DIRECTORY_SEPARATOR
    . 'autoload.php';

$app = new App();
$app->start();

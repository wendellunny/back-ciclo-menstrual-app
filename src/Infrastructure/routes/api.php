<?php

use CicloMenstrual\Infrastructure\Controllers\Auth\LoginController;
use CicloMenstrual\Infrastructure\Controllers\Auth\RegisterController;
use CicloMenstrual\Infrastructure\Controllers\MenstrualCalendar\MenstrualCalendarController;
use CicloMenstrual\Infrastructure\Controllers\MenstrualDateRegisterController;
use CicloMenstrual\Infrastructure\Middlewares\JwtMiddleware;
use CicloMenstrual\Infrastructure\Services\Router\Route;

/**
 * @var Route $route
 */
$route->get('
    /menstrual-calendar',
    [MenstrualCalendarController::class, 'show'],
    ['middlewares' => [$di->get(JwtMiddleware::class)]]
);
$route->post(
    '/menstrual-date/register',
    [MenstrualCalendarController::class, 'storeDate'],
    ['middlewares' => [$di->get(JwtMiddleware::class)]]
);

$route->post('/login', [LoginController::class, 'execute']);

$route->post('/register', [RegisterController::class, 'execute']);

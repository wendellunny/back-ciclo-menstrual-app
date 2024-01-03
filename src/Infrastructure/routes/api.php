<?php

use CicloMenstrual\Infrastructure\Controllers\Authentication\LoginController;
use CicloMenstrual\Infrastructure\Controllers\MenstrualCalendar\MenstrualCalendarController;
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

$route->post('/login', [LoginController::class, 'login']);

$route->post('/register', [LoginController::class, 'register']);

$route->post('/logout', [LoginController::class, 'logout']);

<?php

use CicloMenstrual\Infrastructure\Controllers\Auth\LoginController;
use CicloMenstrual\Infrastructure\Controllers\MenstrualCalendarController;
use CicloMenstrual\Infrastructure\Controllers\MenstrualDateRegisterController;
use CicloMenstrual\Infrastructure\Gateways\Route;
use CicloMenstrual\Infrastructure\Middlewares\JwtMiddleware;
use CicloMenstrual\Infrastructure\ServiceProviders\RouteGroup;

use function DI\autowire;
use function DI\get;

$route = Route::getInstance();

/**
 * Api Routes
 */

$route->get(
    '/menstrual-calendar',
    MenstrualCalendarController::class,
    'menstrual-calendar',
    [JwtMiddleware::class]
);
$route->post(
    '/menstrual-date/register',
    MenstrualDateRegisterController::class,
    'menstrual-date-register',
    [JwtMiddleware::class]
);

$route->post('/login', LoginController::class, 'login');
<?php

use CicloMenstrual\Infrastructure\Controllers\Auth\LoginController;
use CicloMenstrual\Infrastructure\Controllers\Auth\RegisterController;
use CicloMenstrual\Infrastructure\Controllers\MenstrualCalendarController;
use CicloMenstrual\Infrastructure\Controllers\MenstrualDateRegisterController;
use CicloMenstrual\Infrastructure\Gateways\RouterGateway;
use CicloMenstrual\Infrastructure\Middlewares\JwtMiddleware;


$route = RouterGateway::getInstance();

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
$route->post('/register', RegisterController::class, 'register');
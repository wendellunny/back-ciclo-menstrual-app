<?php

use CicloMenstrual\Infrastructure\Controllers\Auth\LoginController;
use CicloMenstrual\Infrastructure\Controllers\Auth\RegisterController;
use CicloMenstrual\Infrastructure\Controllers\MenstrualCalendarController;
use CicloMenstrual\Infrastructure\Controllers\MenstrualDateRegisterController;
use CicloMenstrual\Infrastructure\Middlewares\JwtMiddleware;


// TODO: Implementar uma forma de injetar o objeto diretamente na rota, tanto o controller como o middleware

/**
 * Api Routes
 */

$this->route->get(
    '/menstrual-calendar',
    MenstrualCalendarController::class,
    'menstrual-calendar',
    [JwtMiddleware::class]
);
$this->route->post(
    '/menstrual-date/register',
    MenstrualDateRegisterController::class,
    'menstrual-date-register',
    [JwtMiddleware::class]
);

$this->route->post('/login', LoginController::class, 'login');
$this->route->post('/register', RegisterController::class, 'register');
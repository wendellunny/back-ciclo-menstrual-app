<?php

use CicloMenstrual\Infrastructure\Controllers\Auth\LoginController;
use CicloMenstrual\Infrastructure\Controllers\Auth\RegisterController;
use CicloMenstrual\Infrastructure\Controllers\MenstrualCalendarController;
use CicloMenstrual\Infrastructure\Controllers\MenstrualDateRegisterController;
use CicloMenstrual\Infrastructure\Middlewares\JwtMiddleware;


/**
 * Api Routes
 */
$this->route->get(
    '/menstrual-calendar',
    $this->container->get(MenstrualCalendarController::class),
    'menstrual-calendar',
    [$this->container->get(JwtMiddleware::class)]
);
$this->route->post(
    '/menstrual-date/register',
    $this->container->get(MenstrualDateRegisterController::class),
    'menstrual-date-register',
    [$this->container->get(JwtMiddleware::class)]
);

$this->route->post('/login', $this->container->get(LoginController::class), 'login');
$this->route->post('/register', $this->container->get(RegisterController::class), 'register');
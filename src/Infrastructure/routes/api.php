<?php

use CicloMenstrual\Infrastructure\Controllers\Auth\LoginController;
use CicloMenstrual\Infrastructure\Controllers\TesteController;
use CicloMenstrual\Infrastructure\Controllers\MenstrualCalendarController;
use CicloMenstrual\Infrastructure\Controllers\MenstrualDateRegisterController;
use CicloMenstrual\Infrastructure\Gateways\Route;

$route = Route::getInstance();

/**
 * Api Routes
 */

$route->get('/menstrual-calendar', MenstrualCalendarController::class, 'menstrual-calendar');
$route->post('/menstrual-date/register', MenstrualDateRegisterController::class, 'menstrual-date-register');
// $route->post('/teste', TesteController::class, 'teste');
$route->post('/login', LoginController::class, 'login');
<?php

use CicloMenstrual\Infrastructure\Controllers\MenstrualCalendarController;
use CicloMenstrual\Infrastructure\Controllers\MenstrualDateRegisterController;
use CicloMenstrual\Infrastructure\Gateways\Route;

$route = Route::getInstance();

/**
 * Api Routes
 */

$route->get('/menstrual-calendar', MenstrualCalendarController::class, 'menstrual-calendar');
$route->post('/menstrual-date/register', MenstrualDateRegisterController::class, 'menstrual-date-register');
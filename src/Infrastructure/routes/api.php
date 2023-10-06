<?php

use CicloMenstrual\Infrastructure\Controllers\MenstrualPeriodController;
use CicloMenstrual\Infrastructure\Gateways\Route;

$route = Route::getInstance();

/**
 * Api Routes
 */

$route->get('/menstrual-calendar', MenstrualPeriodController::class, 'home');
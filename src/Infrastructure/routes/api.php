<?php

use CicloMenstrual\Infrastructure\Controllers\MenstrualPeriodController;
use CicloMenstrual\Infrastructure\Gateways\Route;

$route = Route::getInstance();

/**
 * Api Routes
 */

$route->get('/home', MenstrualPeriodController::class, 'home');
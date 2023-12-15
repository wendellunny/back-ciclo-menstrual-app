<?php

namespace CicloMenstrual\Infrastructure\Services\Router;

use Closure;

interface RouteGroupInterface
{
    /**
     * Handle
     *
     * @param Closure $routes
     * @param array $middlewares
     * @return void
     */
    public function handle(Closure $routes, array $middlewares);
}
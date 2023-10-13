<?php

namespace CicloMenstrual\Infrastructure\ServiceProviders;

class RouteGroup
{
    public function group(array $middlewares ,callable $routes)
    {
        foreach($middlewares as $middleware) {
            $middleware->handle();
        }

        $routes();
    }
}
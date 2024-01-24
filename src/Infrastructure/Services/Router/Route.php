<?php

namespace CicloMenstrual\Infrastructure\Services\Router;

use Aura\Router\Map as RouteMap;
use Closure;
use DI\Container as DiContainer;

//TODO: fazer funfar
class Route
{
    public function __construct(private RouteMap $map, private DiContainer $di)
    {
    }

    public function get(string $path, array|Closure $handler, ?array $options = []): void
    {
        $name = $this->buildName($options['name'] ?? $path, $options['prefix'] ?? '');
        $path = $this->buildPath($path, $options['prefix'] ?? '');
        
        $middlewares = $options['middlewares'] ?? [];

        $this->map->get($name, $path, $this->buildHandler($handler, $middlewares));
    }

    public function post(string $path, array|Closure $handler, ?array $options = []): void
    {
        $name = $this->buildName($options['name'] ?? $path, $options['prefix'] ?? '');
        $path = $this->buildPath($path, $options['prefix'] ?? '');
        
        $middlewares = $options['middlewares'] ?? [];

        $this->map->post($name, $path, $this->buildHandler($handler, $middlewares));
    }

    public function getRouteMap(): RouteMap
    {
        return $this->map;
    }

    private function buildPath(string $path, ?string $prefix): string
    {
        return $prefix ? "/{$prefix}{$path}" : $path;
    }

    private function buildName(string $name, ?string $prefix): string
    {
        return $prefix ? "{$prefix}.{$name}" : $name;
    }

    private function buildHandler(array|Closure $baseHandler, ?array $middlewares = []): Closure
    {
        if($baseHandler instanceof Closure) {
            return function() use($baseHandler, $middlewares){
                array_walk($middlewares, function($middleware){
                    $middleware->handle();
                });

                $baseHandler();
            };
        }

        $controller = $this->di->get($baseHandler[0]);
        $method = $baseHandler[1];

        return function() use ($controller, $method, $middlewares){
            array_walk($middlewares, function($middleware){
                $middleware->handle();
            });

            $controller->$method();
        };
    }
}
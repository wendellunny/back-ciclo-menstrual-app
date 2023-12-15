<?php

namespace CicloMenstrual\Infrastructure\Services\Router;

use Aura\Router\RouterContainer;
use Closure;
use DI\Container as DiContainer;
use Psr\Http\Message\RequestInterface;

class Router
{
    private Closure $callable;

    public function __construct(
        private readonly RequestInterface   $request,
        private readonly RouterContainer    $routerContainer,
        private readonly DiContainer        $di
    ) {
        
    }

    public function configure(string $basePath): self
    {
        $this->callable = function() use ($basePath) {
            $route = $this->di->get(Route::class);
            $di = $this->di;
            include $basePath;
        };

        return $this;
    }

    public function handle(): void
    {
        $callable = $this->callable;
        $callable();
    }
}
<?php

namespace CicloMenstrual\Infrastructure\Gateways;

use Aura\Router\Map;
use Aura\Router\RouterContainer;
use CicloMenstrual\Infrastructure\Api\Controllers\ControllerInterface;
use CicloMenstrual\Infrastructure\Api\Gateways\RouterGatewayInterface;
use CicloMenstrual\Infrastructure\Api\Middlewares\MiddlewareInterface;
use DI\Container;
use Exception;
use Psr\Http\Message\RequestInterface;

class RouterGateway implements RouterGatewayInterface
{
    /** @var Map $map */
    private Map $map;


    public function __construct(
        private RequestInterface $request,
        private RouterContainer $routerContainer,
        private Container $container
    ) {
        $this->map = $this->routerContainer->getMap();
    }
    
    /**
     * Get
     *
     * @param string $uri
     * @param string $contrellerClass
     * @param string $route_name
     * @param array $middlewares
     * @return void
     */
    public function get(string $uri, ControllerInterface $controller, string $route_name, $middlewares = []): void
    {
        $this->map->get($route_name, $uri, function() use($controller, $middlewares) {
            array_walk($middlewares, function($middleware){
                if(!$middleware instanceof MiddlewareInterface) {
                    $class = MiddlewareInterface::class;
                    throw new Exception("middleware must implements {$class}");
                }

                $middleware->handle();
            });
            
            return $controller->execute();
        });
    }

    /**
     * Post
     *
     * @param string $uri
     * @param string $contrellerClass
     * @param string $route_name
     * @param array $middlewares
     * @return void
     */
    public function post(string $uri, ControllerInterface $controller, string $route_name, $middlewares = []): void
    {
        $this->map->post($route_name, $uri, function() use($controller, $middlewares)
        {
            array_walk($middlewares, function($middleware){
                if(!$middleware instanceof MiddlewareInterface) {
                    $class = MiddlewareInterface::class;
                    throw new Exception("middleware must implements {$class}");
                }
                
                $middleware->handle();
            });
            
            return $controller->execute();
        });
    }

    /**
     * Match
     *
     * @return void
     */
    public function match(): void
    {
        $matcher = $this->routerContainer->getMatcher();
        $route = $matcher->match($this->request);

        if (! $route) {
            http_response_code(404);
            echo json_encode(['status'=> 404, 'message' => 'Not Found']);
            exit;
        }

        foreach ($route->attributes as $key => $val) {
            $this->request = $this->request->withAttribute($key, $val);
        }

        $callable = $route->handler;
        $response = $callable();

        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }

        http_response_code($response->getStatusCode());
        echo $response->getBody();
    }

}
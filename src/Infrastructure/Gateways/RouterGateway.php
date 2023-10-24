<?php

namespace CicloMenstrual\Infrastructure\Gateways;

use Aura\Router\Map;
use Aura\Router\RouterContainer;
use CicloMenstrual\Infrastructure\Singleton;
use DI\Container;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\ServerRequestFactory;

class RouterGateway extends Singleton
{
    /** @var Map $map */
    private Map $map;

    /** @var Cotainer $container */
    private Container $container;
    
    /** @var ServerRequest $request */
    private ServerRequest $request;

    /** @var RouterContainer $routerContainer */
    private RouterContainer $routerContainer;

    /**
     * Init
     *
     * @param RouterContainer $routerContainer
     * @param Container $container
     * @return void
     */
    public function init(RouterContainer $routerContainer, Container $container)
    {
        $this->request = ServerRequestFactory::fromGlobals(
            $_SERVER,
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES
        );
        
        $this->routerContainer = $routerContainer;
        $this->map = $routerContainer->getMap();
        $this->container = $container;
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
    public function get(string $uri, string $contrellerClass, string $route_name, $middlewares = [])
    {
        $controller = $this->container->get($contrellerClass);

        $this->map->get($route_name, $uri, function() use($controller, $middlewares) {
            array_walk($middlewares, function($middleware){
                $middlewareObject = $this->container->get($middleware);
                $middlewareObject->handle();
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
    public function post(string $uri, string $contrellerClass, string $route_name, $middlewares = [])
    {
        $controller = $this->container->get($contrellerClass);
        
        $this->map->post($route_name, $uri, function() use($controller, $middlewares)
        {
            array_walk($middlewares, function($middleware){
                $object = $this->container->get($middleware);
                $object->handle();
            });
            
            return $controller->execute();
        });
    }

    /**
     * Match
     *
     * @return void
     */
    public function match()
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
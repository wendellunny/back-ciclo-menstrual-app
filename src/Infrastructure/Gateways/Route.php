<?php

namespace CicloMenstrual\Infrastructure\Gateways;

use Aura\Router\Map;
use Aura\Router\RouterContainer;
use CicloMenstrual\Infrastructure\Singleton;
use DI\Attribute\Inject;
use DI\Container;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\ServerRequestFactory;

class Route extends Singleton
{
    private Map $map;
    private Container $container;
    private ServerRequest $request;
    private RouterContainer $routerContainer;

    #[Inject]
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

    public function get(string $uri, string $contrellerClass, string $route_name)
    {
        $controller = $this->container->get($contrellerClass);

        $this->map->get($route_name, $uri, function(
            RequestInterface $request, 
            ResponseInterface $response) use($controller)
        {
            return $controller->execute($request, $response);
        });
    }

    public function post(string $uri, string $contrellerClass, string $route_name)
    {
        $controller = $this->container->get($contrellerClass);
        
        $this->map->post($route_name, $uri, function($request, $response) use($controller){
            $controller->execute($request, $response);
        });
    }

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
        $response = new Response();
        $response = $callable($this->request, $response);

        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }

        http_response_code($response->getStatusCode());
        echo $response->getBody();
    }
}
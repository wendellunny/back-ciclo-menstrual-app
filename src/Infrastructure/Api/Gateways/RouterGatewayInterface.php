<?php

namespace CicloMenstrual\Infrastructure\Api\Gateways;

use CicloMenstrual\Infrastructure\Api\Controllers\ControllerInterface;

interface RouterGatewayInterface
{
    /**
     * Get
     *
     * @param string $uri
     * @param string $contrellerClass
     * @param string $route_name
     * @param array $middlewares
     * @return void
     */
    public function get(string $uri, ControllerInterface $controller, string $route_name, $middlewares = []): void;


    /**
     * Post
     *
     * @param string $uri
     * @param string $contrellerClass
     * @param string $route_name
     * @param array $middlewares
     * @return void
     */
    public function post(string $uri, ControllerInterface $controller, string $route_name, $middlewares = []): void;

    /**
     * Match
     *
     * @return void
     */
    public function match(): void;
}
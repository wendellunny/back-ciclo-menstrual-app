<?php

namespace Tests\Infrastructure\Gateways;

use Aura\Router\RouterContainer;
use CicloMenstrual\Infrastructure\Api\Controllers\ControllerInterface;
use CicloMenstrual\Infrastructure\Gateways\RouterGateway;
use PHPUnit\Framework\TestCase;
use DI\Container;
use Psr\Http\Message\RequestInterface;

class RouterGatewayTest extends TestCase
{
    private RouterGateway $instance;
    private RouterContainer $routerContainerMock;
    private Container $containerMock;
    private RequestInterface $requestMock;
    private ControllerInterface $controllerMock;

    public function setUp(): void
    {
        $this->setMocks();
        $this->setInstance();
    }

    private function setMocks(): void
    {
        $this->routerContainerMock = $this->createMock(RouterContainer::class);
        $this->containerMock = $this->createMock(Container::class);
        $this->requestMock = $this->createMock(RequestInterface::class);
        $this->controllerMock = $this->createMock(ControllerInterface::class);
    }

    private function setInstance(): void
    {
        $this->instance = new RouterGateway($this->requestMock, $this->routerContainerMock, $this->containerMock);
    }


    public function testPost(): void
    {
        $this->instance->post('/teste', $this);
    }
    
}
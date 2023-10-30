<?php

namespace Tests\Infrastructure\Gateways;

use Aura\Router\RouterContainer;
use CicloMenstrual\Infrastructure\Api\Controllers\ControllerInterface;
use CicloMenstrual\Infrastructure\Gateways\RouterGateway;
use PHPUnit\Framework\TestCase;
use DI\Container;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RouterGatewayTest extends TestCase
{
    private RouterGateway $instance;
    private MockObject|RouterContainer $routerContainerMock;
    private MockObject|Container $containerMock;
    private MockObject|RequestInterface $requestMock;
    private MockObject|ResponseInterface $responseMock;
    private MockObject|ControllerInterface $controllerMock;

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
        $this->responseMock  = $this->createMock(ResponseInterface::class);
        $this->controllerMock = $this->createMock(ControllerInterface::class);
    }

    private function setInstance(): void
    {
        $this->instance = new RouterGateway($this->requestMock, $this->routerContainerMock, $this->containerMock);
    }


    public function testPost(): void
    {
        $this->controllerMock
            ->expects($this->once())
            ->method('execute')
            ->willReturn($this->responseMock);
        
        $response = $this->instance->post('/teste', $this->controllerMock, 'teste');
        $this->assertEquals($this->responseMock, $response);
    }
    
}
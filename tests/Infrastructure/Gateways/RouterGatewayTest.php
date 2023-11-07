<?php

namespace Tests\Infrastructure\Gateways;

use Aura\Router\Map;
use Aura\Router\RouterContainer;
use CicloMenstrual\Infrastructure\Api\Controllers\ControllerInterface;
use CicloMenstrual\Infrastructure\Gateways\RouterGateway;
use PHPUnit\Framework\TestCase;
use DI\Container;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Aura\Router\Route;
use Aura\Router\Matcher;

class RouterGatewayTest extends TestCase
{
    private RouterGateway $instance;
    private MockObject|RouterContainer $routerContainerMock;
    private MockObject|Container $containerMock;
    private MockObject|RequestInterface $requestMock;
    private MockObject|ControllerInterface $controllerMock;
    private MockObject|Map $mapMock;
    private MockObject|Route $routeMock;
    private MockObject|Matcher $matcherMock;

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
        $this->mapMock = $this->createMock(Map::class);
        $this->routeMock = $this->createMock(Route::class);
        $this->matcherMock = $this->createMock(Matcher::class);
    }

    private function setInstance(): void
    {
        $this->instance = new RouterGateway($this->requestMock, $this->routerContainerMock, $this->containerMock);
    }


    /**
     * @test
     * @dataProvider dataProviderMethods
     *
     * @return void
     */
    public function testPost(string $method, string $routeName, string $uri): void
    {
        $this->routerContainerMock
            ->expects($this->once())
            ->method('getMap')
            ->willReturn($this->mapMock);

        $this->mapMock
            ->expects($this->once())
            ->method($method);
        
        $this->instance->$method($uri, $this->controllerMock, $method);
    }

    /**
     * Data provider
     *
     * @return array
     */
    public static function dataProviderMethods(): array
    {
        return [
            'whenPost' => [
                'method' => 'post',
                'routeName' => 'teste',
                'uri' => '/teste'
            ],
            'whenGet' => [
                'method' => 'get',
                'routeName' => 'teste',
                'uri' => '/teste'
            ]
        ];
    }
    
}
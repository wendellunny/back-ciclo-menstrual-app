<?php

namespace Tests\Infrastructure\Services\Router;

use Aura\Router\RouterContainer;
use CicloMenstrual\Infrastructure\Services\Router\Route;
use CicloMenstrual\Infrastructure\Services\Router\Router;
use DI\Container as DiContainer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/**
 * Test to use CicloMenstrual\Infrastructure\Services\Router\Router class
 */
class RouterTest extends TestCase
{
    private Router                      $instance;
    private MockObject|RequestInterface $requestMock;
    private MockObject|RouterContainer  $routerContainerMock;
    private MockObject|DiContainer      $diMock;

    /**
     * Set up method
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->setMocks();
        $this->setInstance();
    }

    /**
     * Set mocks
     *
     * @return void
     */
    private function setMocks(): void
    {
        $this->requestMock          = $this->createMock(RequestInterface::class);
        $this->routerContainerMock  = $this->createMock(RouterContainer::class);
        $this->diMock               = $this->createMock(DiContainer::class);
    }

    /**
     * Set instance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new Router(
            $this->requestMock,
            $this->routerContainerMock,
            $this->diMock
        );
    }

    /**
     * Test configure and handle
     *
     * @return void
     */
    public function testConfigureAndHandle(): void
    {
        $this->diMock
            ->expects($this->once())
            ->method('get')
            ->with(Route::class);

        $this->assertEquals(
            $this->instance,
            $this->instance->configure('base/path/test')
        );

        $this->instance->handle();
    }
}
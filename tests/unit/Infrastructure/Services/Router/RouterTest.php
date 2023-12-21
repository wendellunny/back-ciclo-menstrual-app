<?php

namespace Tests\Infrastructure\Services\Router;

use Aura\Router\RouterContainer;
use CicloMenstrual\Infrastructure\Services\Router\Router;
use DI\Container as DiContainer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class RouterTest extends TestCase
{
    private Router $instance;
    private MockObject|RequestInterface $requestMock;
    private MockObject|RouterContainer $routerContainerMock;
    private MockObject|DiContainer $diMock;

    public function setUp(): void
    {
        $this->setMocks();
        $this->setInstance();
    }

    private function setMocks(): void
    {
        $this->requestMock = $this->createMock(RequestInterface::class);
        $this->routerContainerMock = $this->createMock(RouterContainer::class);
        $this->diMock = $this->createMock(DiContainer::class);

        /** TODO: Continuar teste */
    }

    private function setInstance(): void
    {
        $this->instance = new Router(
            $this->requestMock,
            $this->routerContainerMock,
            $this->diMock
        );
    }
}
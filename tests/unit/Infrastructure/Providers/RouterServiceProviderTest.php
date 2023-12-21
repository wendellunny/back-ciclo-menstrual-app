<?php

namespace Tests\Infrastructure\Providers;

use CicloMenstrual\Infrastructure\Providers\RouterServiceProvider;
use CicloMenstrual\Infrastructure\Services\Router\Router;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Test from class CicloMenstrual\Infrastructure\Providers\RouterServiceProvider
 */
class RouterServiceProviderTest extends TestCase
{
    private RouterServiceProvider   $instance;
    private MockObject|Router       $routerMock;

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
        $this->routerMock = $this->createMock(Router::class);
    }

    /**
     * Set instance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new RouterServiceProvider(
            $this->routerMock
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function testHandle(): void
    {
        $this->routerMock
            ->expects($this->once())
            ->method('configure')
            ->willReturnSelf();

        $this->routerMock
            ->expects($this->once())
            ->method('handle');

        $this->instance->handle();
    }
}

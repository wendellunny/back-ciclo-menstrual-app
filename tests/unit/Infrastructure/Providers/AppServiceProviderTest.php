<?php

namespace Tests\Infrastructure\Providers;

use CicloMenstrual\Infrastructure\Providers\AppServiceProvider;
use CicloMenstrual\Infrastructure\Providers\RouterServiceProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Test from CicloMenstrual\Infrastructure\Providers\AppServiceProvider
 */
class AppServiceProviderTest extends TestCase
{
    private AppServiceProvider                  $instance;
    private MockObject|RouterServiceProvider    $routerServiceProviderMock;

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
        $this->routerServiceProviderMock = $this->createMock(RouterServiceProvider::class);
    }

    /**
     * Set instance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new AppServiceProvider($this->routerServiceProviderMock);
    }

    /**
     * @test
     *
     * @return void
     */
    public function testHandle(): void
    {
        $this->routerServiceProviderMock
            ->expects($this->once())
            ->method('handle');

        $this->instance->handle();
    }
}
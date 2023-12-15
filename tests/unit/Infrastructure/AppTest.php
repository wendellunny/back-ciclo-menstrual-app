<?php

namespace Tests\Infrastructure;

use CicloMenstrual\Infrastructure\App;
use CicloMenstrual\Infrastructure\Providers\AppServiceProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * Test from CicloMenstrual\Infrastructure\App
 */
class AppTest extends TestCase
{
    private App                             $instance;
    private MockObject|ContainerInterface   $diContainerMock;
    private MockObject|AppServiceProvider   $appServiceProviderMock;

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
        $this->diContainerMock          = $this->createMock(ContainerInterface::class);
        $this->appServiceProviderMock   = $this->createMock(AppServiceProvider::class);
    }

    /**
     * Set instance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new App($this->diContainerMock);
    }

    /**
     * @test
     *
     * @return void
     */
    public function testStart(): void
    {
        $this->diContainerMock
            ->expects($this->once())
            ->method('get')
            ->with(AppServiceProvider::class)
            ->willReturn($this->appServiceProviderMock);

        $this->appServiceProviderMock
            ->expects($this->once())
            ->method('handle');

        $this->instance->start();
    }
}
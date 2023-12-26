<?php

namespace Tests\Infrastructure\Services\Router;

use Aura\Router\Map as RouteMap;
use DI\Container as DiContainer;
use CicloMenstrual\Infrastructure\Services\Router\Route;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Test to CicloMenstrual\Infrastructure\Services\Router\Route class
 * TODO: melhorar cobertura deste teste
 */
class RouteTest extends TestCase
{
    private Route                   $instance;
    private MockObject|RouteMap     $routeMapMock;
    private MockObject|DiContainer  $diMock;

    /**
     * Set up method
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
        $this->routeMapMock = $this->createMock(RouteMap::class);
        $this->diMock       = $this->createMock(DiContainer::class);

    }

    /**
     * Set instance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new Route(
            $this->routeMapMock,
            $this->diMock
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function testGet(): void
    {
        
        $this->routeMapMock
            ->expects($this->once())
            ->method('get');
    
        $this->instance->get('/route/test', function(){var_dump('teste');});
    }

    /**
     * @test
     *
     * @return void
     */
    public function testPost(): void
    {
        
        $this->routeMapMock
            ->expects($this->once())
            ->method('post');
    
        $this->instance->post('/route/test', function(){var_dump('teste');});
    }

    /**
     * @test
     *
     * @return void
     */
    public function testGetRouteMap(): void
    {
        $this->assertEquals(
            $this->routeMapMock,
            $this->instance->getRouteMap()
        );
    }
}
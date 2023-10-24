<?php

namespace Tests\Infrastructure\Gateways;

use Aura\Router\RouterContainer;
use CicloMenstrual\Infrastructure\Gateways\RouterGateway;
use PHPUnit\Framework\TestCase;

class RouterGatewayTest extends TestCase
{
    private RouterGateway $instance;
    private RouterContainer $routerContainerMock;
    private 

    public function setUp(): void
    {
        $this->setMocks();
        $this->setInstance();
    }

    private function setMocks(): void
    {
    
    }

    private function setInstance(): void
    {
        $this->instance = RouterGateway::getInstance();
    }

    public function testInit(): void
    {
        $this->instance->init();
    }
}
<?php

namespace Tests\Domain\MenstrualCalendar\Factory;

use CicloMenstrual\Domain\MenstrualCalendar\Factory\Factory;
use PHPUnit\Framework\TestCase;
use stdClass;

class FactoryTest extends TestCase
{
    private Factory $instance;

    /**
     * Set up method
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->setInstance();
    }

    /**
     * Set instance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new Factory();
    }

    /**
     * Test create
     *
     * @return void
     */
    public function testCreate(): void
    {
        $expect = new stdClass();
        $this->assertEquals($expect, $this->instance->create());
    }
}

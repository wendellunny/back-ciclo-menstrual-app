<?php

namespace Tests\Domain\MenstrualCalendar\Entities\Factories;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\Factories\FertilePeriodFactory;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\FertilePeriod;
use PHPUnit\Framework\TestCase;

class FertilePeridoFactoryTest extends TestCase
{
    
    private FertilePeriodFactory $instance;

    /**
     * Set up Method
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
        $this->instance = new FertilePeriodFactory();
    }

    /**
     * Test create
     *
     * @return void
     */
    public function testCreate(): void
    {

        $expect = new FertilePeriod();
        $this->assertEquals(
            $expect,
            $this->instance->create()
        );
    }
}

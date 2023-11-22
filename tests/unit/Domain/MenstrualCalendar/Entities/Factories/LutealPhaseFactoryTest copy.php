<?php

namespace Tests\Domain\MenstrualCalendar\Entities\Factories;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\Factories\LutealPhaseFactory;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\LutealPhase;
use PHPUnit\Framework\TestCase;

class LutealPhaseFactoryTest extends TestCase
{
    
    private LutealPhaseFactory $instance;

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
        $this->instance = new LutealPhaseFactory();
    }

    /**
     * Test create
     *
     * @return void
     */
    public function testCreate(): void
    {

        $expect = new LutealPhase();
        $this->assertEquals(
            $expect,
            $this->instance->create()
        );
    }
}

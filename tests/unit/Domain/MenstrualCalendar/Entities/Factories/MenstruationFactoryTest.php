<?php

namespace Tests\Domain\MenstrualCalendar\Entities\Factories;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\Factories\MenstruationFactory;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Menstruation;
use PHPUnit\Framework\TestCase;

class MenstruationFactoryTest extends TestCase
{
    
    private MenstruationFactory $instance;

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
        $this->instance = new MenstruationFactory();
    }

    /**
     * Test create
     *
     * @return void
     */
    public function testCreate(): void
    {

        $expect = new Menstruation();
        $this->assertEquals(
            $expect,
            $this->instance->create()
        );
    }
}

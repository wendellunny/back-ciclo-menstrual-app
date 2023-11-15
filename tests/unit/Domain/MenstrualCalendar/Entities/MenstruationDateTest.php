<?php

namespace Tests\Domain\MenstrualCalendar\Entities;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\MenstruationDate;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class MenstruationDateTest extends TestCase
{

    private MenstruationDate $instance;

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
        $this->instance = new MenstruationDate();
    }

    /**
     * @test
     *
     * @return void
     */
    public function testGetAndSetInitial(): void
    {
        $initialDate = new DateTimeImmutable('2023-11-15');
        $setterValue = $this->instance->setInitial($initialDate);
        $getterValue = $this->instance->getInitial();

        $this->assertEquals(
            $this->instance,
            $setterValue
        );

        $this->assertEquals(
            $initialDate,
            $getterValue
        );
    }
}
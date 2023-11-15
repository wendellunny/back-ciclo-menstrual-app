<?php

namespace Tests\Domain\MenstrualCalendar\Entities\Dtos;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\FertilePeriodData;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class FertilePeriodDataTest extends TestCase
{
    private FertilePeriodData $instance;
    private DateTimeImmutable $initialDate;
    private DateTimeImmutable $endDate;

    /**
     * Set up
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->setMocks();
        $this->setInstance();
    }

    private function setMocks(): void
    {
        $this->initialDate = new DateTimeImmutable('2023-11-13');
        $this->endDate = new DateTimeImmutable('2023-12-13');
    }

    /**
     * Set instance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new FertilePeriodData($this->initialDate, $this->endDate);
    }

    /**
     * Test getters
     *
     * @return void
     */
    public function testGetters(): void
    {
        $this->assertEquals(
            $this->initialDate,
            $this->instance->getInitialDate()
        );

        $this->assertEquals(
            $this->endDate,
            $this->instance->getEndDate()
        );
    }
}

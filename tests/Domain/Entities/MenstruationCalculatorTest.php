<?php

namespace Tests\Domain\Entities;

use CicloMenstrual\Domain\Entities\Data\Menstruation;
use CicloMenstrual\Domain\Entities\MenstruationCalculator;
use DateInterval;
use DateTime;
use PHPUnit\Framework\TestCase;

class MenstruationCalculatorTest extends TestCase
{
    /**
     * @var MenstruationCalculator
     */
    private MenstruationCalculator $instance;
    
    /**
     * Setup method
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->instance = new MenstruationCalculator();
    }

    /**
     * @test
     *
     * @return void
     */
    public function testCalculate(): void
    {
        $date = new DateTime();
        $dateInterval = DateInterval::createFromDateString('5 days');

        $expect = new Menstruation(
            $date,
            $date->add($dateInterval)
        );

        $result = $this->instance->calculate($date);

        $this->assertEquals($expect, $result);
    }
}
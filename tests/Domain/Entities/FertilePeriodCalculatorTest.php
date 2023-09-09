<?php

namespace Tests\Domain\Entities\Domain;

use CicloMenstrual\Domain\Api\Entities\Data\MenstruationInterface;
use CicloMenstrual\Domain\Entities\FertilePeriodCalculator;
use DateInterval;
use DateTime;
use PHPUnit\Framework\TestCase;

class FertilePeriodCalculatorTest extends TestCase
{
    private FertilePeriodCalculator $instance;
    private MenstruationInterface $menstruation;

    public function setUp(): void
    {
        $this->instance = new FertilePeriodCalculator();
        $this->menstruation = $this->createMock(MenstruationInterface::class);
    }

    /**
     * @test
     *
     * @return void
     */
    public function testCalculate(): void
    {
        $initialDate = new DateTime();
        $dateInterval = DateInterval::createFromDateString('14 days');
        
        $expect = [
            'initial_date' => $initialDate,
            'end_date' => $initialDate->add($dateInterval)
        ];

        $this->menstruation
            ->expects($this->once())
            ->method('getInitialDate')
            ->willReturn($initialDate);
        
        $result = $this->instance->calculate($this->menstruation);

        $this->assertEquals($expect, $result);
    }
}
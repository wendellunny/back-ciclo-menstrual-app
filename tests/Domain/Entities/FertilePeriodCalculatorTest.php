<?php

namespace Tests\Domain\Entities\Domain;

use CicloMenstrual\Domain\Api\Entities\Data\MenstruationInterface;
use CicloMenstrual\Domain\Entities\FertilePeriodCalculator;
use DateInterval;
use DateTimeImmutable;
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
        $initialDateMenstruation = new DateTimeImmutable();
        $initialDateInterval = DateInterval::createFromDateString('14 days');
        $initialDate = $initialDateMenstruation->add($initialDateInterval);
        $endDateInterval = DateInterval::createFromDateString('5 days');

        $expect = [
            'initial_date' => $initialDate,
            'end_date' => $initialDate->add($endDateInterval)
        ];

        $this->menstruation
            ->expects($this->once())
            ->method('getInitialDate')
            ->willReturn($initialDateMenstruation);
        
        $result = $this->instance->calculate($this->menstruation);

        $this->assertEquals($expect, $result);
    }
}
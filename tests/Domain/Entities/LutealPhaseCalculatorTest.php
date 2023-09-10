<?php

namespace Tests\Domain\Entities;

use CicloMenstrual\Domain\Entities\Data\FertilePeriod;
use CicloMenstrual\Domain\Entities\Data\LutealPhase;
use CicloMenstrual\Domain\Entities\LutealPhaseCalculator;
use DateInterval;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class LutealPhaseCalculatorTest extends TestCase
{
    private FertilePeriod $fertilPeriodMock;
    private LutealPhaseCalculator $instance;

    public function setUp(): void
    {
        $this->fertilPeriodMock = $this->createMock(FertilePeriod::class);
        $this->instance = new LutealPhaseCalculator();
    }

    public function testeCalculate(): void
    {
        $fertilPeriodEndDate = new DateTimeImmutable();
        $this->fertilPeriodMock
            ->expects($this->once())
            ->method('getEndDate')
            ->willReturn($fertilPeriodEndDate);

        $expect = new LutealPhase(
            $fertilPeriodEndDate,
            $fertilPeriodEndDate->add(DateInterval::createFromDateString('9 days'))
        );

        $result = $this->instance->calculate($this->fertilPeriodMock);

        $this->assertEquals($expect, $result);
    }
}
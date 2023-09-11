<?php

namespace Tests\Domain\Entities;

use CicloMenstrual\Domain\Api\Entities\Data\LutealPhaseInterface;
use CicloMenstrual\Domain\Entities\Data\Factories\LutealPhaseFactory;
use CicloMenstrual\Domain\Entities\Data\FertilePeriod;
use CicloMenstrual\Domain\Entities\Data\LutealPhase;
use CicloMenstrual\Domain\Entities\LutealPhaseCalculator;
use DateInterval;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class LutealPhaseCalculatorTest extends TestCase
{
    private LutealPhaseFactory $lutealPhaseFactoryMock;
    private LutealPhaseInterface $lutealPhaseMock;
    private FertilePeriod $fertilPeriodMock;
    private LutealPhaseCalculator $instance;

    public function setUp(): void
    {
        $this->lutealPhaseFactoryMock = $this->createMock(LutealPhaseFactory::class);
        $this->fertilPeriodMock = $this->createMock(FertilePeriod::class);
        $this->lutealPhaseMock = $this->createMock(LutealPhaseInterface::class);
        $this->instance = new LutealPhaseCalculator($this->lutealPhaseFactoryMock);
    }

    public function testeCalculate(): void
    {
        $fertilPeriodEndDate = new DateTimeImmutable();
        $this->fertilPeriodMock
            ->expects($this->once())
            ->method('getEndDate')
            ->willReturn($fertilPeriodEndDate);
        
        $this->lutealPhaseFactoryMock
            ->expects($this->once())
            ->method('create')
            ->with([
                $fertilPeriodEndDate,
                $fertilPeriodEndDate->add(DateInterval::createFromDateString('9 days'))
            ])
            ->willReturn($this->lutealPhaseMock);

        $result = $this->instance->calculate($this->fertilPeriodMock);

        $this->assertEquals($this->lutealPhaseMock, $result);
    }
}
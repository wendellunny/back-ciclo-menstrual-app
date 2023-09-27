<?php

namespace Tests\Domain\Entities;

use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\LutealPhaseInterface;
use CicloMenstrual\Domain\Entities\Data\MenstrualCicle\Factories\LutealPhaseFactory;
use CicloMenstrual\Domain\Entities\Data\MenstrualCicle\FertilePeriod;
use CicloMenstrual\Domain\Entities\MenstrualCicle\LutealPhaseCalculator;
use DateInterval;
use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class LutealPhaseCalculatorTest extends TestCase
{
    private MockObject|LutealPhaseFactory $lutealPhaseFactoryMock;
    private MockObject|LutealPhaseInterface $lutealPhaseMock;
    private MockObject|FertilePeriod $fertilePeriodMock;
    private LutealPhaseCalculator $instance;

    public function setUp(): void
    {
        $this->lutealPhaseFactoryMock = $this->createMock(LutealPhaseFactory::class);
        $this->fertilePeriodMock = $this->createMock(FertilePeriod::class);
        $this->lutealPhaseMock = $this->createMock(LutealPhaseInterface::class);
        $this->instance = new LutealPhaseCalculator($this->lutealPhaseFactoryMock);
    }

    public function testeCalculate(): void
    {
        $fertilePeriodEndDate = new DateTimeImmutable();
        $lutealPhaseInitialDate = $fertilePeriodEndDate->add(
            DateInterval::createFromDateString('1 day')
        );

        $this->fertilePeriodMock
            ->expects($this->once())
            ->method('getEndDate')
            ->willReturn($fertilePeriodEndDate);
        
        $this->lutealPhaseFactoryMock
            ->expects($this->once())
            ->method('create')
            ->with([
                $lutealPhaseInitialDate,
                $lutealPhaseInitialDate->add(DateInterval::createFromDateString('9 days'))
            ])
            ->willReturn($this->lutealPhaseMock);

        $result = $this->instance->calculate($this->fertilePeriodMock);

        $this->assertEquals($this->lutealPhaseMock, $result);
    }
}
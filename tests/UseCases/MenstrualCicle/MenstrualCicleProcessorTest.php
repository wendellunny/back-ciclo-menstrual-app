<?php

namespace Tests\UseCases\MenstrualCicle;

use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\FertilePeriodInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\LutealPhaseInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\MenstruationInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicleInterface;
use CicloMenstrual\Domain\Entities\Data\Factories\MenstrualCicleFactory;
use CicloMenstrual\Domain\Entities\MenstrualCicle\FertilePeriodCalculator;
use CicloMenstrual\Domain\Entities\MenstrualCicle\LutealPhaseCalculator;
use CicloMenstrual\Domain\Entities\MenstrualCicle\MenstruationCalculator;
use CicloMenstrual\UseCases\MenstrualCicle\MenstrualCicleProcessor;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class MenstrualCicleProcessorTest extends TestCase
{
    private MenstrualCicleProcessor $instance;
    private MenstrualCicleFactory $menstrualCicleFactoryMock;
    private MenstruationCalculator $menstruationCalculatorMock;
    private FertilePeriodCalculator $fertilePeriodCalculatorMock;
    private LutealPhaseCalculator $lutealPhaseCalculatorMock;
    private MenstruationInterface $menstruationMock;
    private FertilePeriodInterface $fertilPeriodMock;
    private LutealPhaseInterface $lutealPhaseMock;
    private MenstrualCicleInterface $menstrualCicleMock;

    public function setUp(): void
    {
        $this->menstrualCicleFactoryMock = $this->createMock(MenstrualCicleFactory::class);
        $this->menstruationCalculatorMock = $this->createMock(MenstruationCalculator::class);
        $this->fertilePeriodCalculatorMock = $this->createMock(FertilePeriodCalculator::class);
        $this->lutealPhaseCalculatorMock  = $this->createMock(LutealPhaseCalculator::class);

        $this->menstruationMock = $this->createMock(MenstruationInterface::class);
        $this->fertilPeriodMock = $this->createMock(FertilePeriodInterface::class);
        $this->lutealPhaseMock = $this->createMock(LutealPhaseInterface::class);
        $this->menstrualCicleMock = $this->createMock(MenstrualCicleInterface::class);

        $this->instance = new MenstrualCicleProcessor(
            $this->menstrualCicleFactoryMock,
            $this->menstruationCalculatorMock,
            $this->fertilePeriodCalculatorMock,
            $this->lutealPhaseCalculatorMock
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function testProcess(): void
    {
        $menstruationDate = new DateTimeImmutable();

        $this->menstruationCalculatorMock
            ->expects($this->once())
            ->method('calculate')
            ->with($menstruationDate)
            ->willReturn($this->menstruationMock);

        $this->fertilePeriodCalculatorMock
            ->expects($this->once())
            ->method('calculate')
            ->with($this->menstruationMock)
            ->willReturn($this->fertilPeriodMock);

        $this->lutealPhaseCalculatorMock
            ->expects($this->once())
            ->method('calculate')
            ->with($this->fertilPeriodMock)
            ->willReturn($this->lutealPhaseMock);

        $this->menstrualCicleFactoryMock
            ->expects($this->once())
            ->method('create')
            ->with([
                $this->menstruationMock,
                $this->fertilPeriodMock,
                $this->lutealPhaseMock
            ])
            ->willReturn($this->menstrualCicleMock);

        $result = $this->instance->process($menstruationDate);

        $this->assertEquals($this->menstrualCicleMock, $result);
    }
}
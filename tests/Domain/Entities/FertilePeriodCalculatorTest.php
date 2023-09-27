<?php

namespace Tests\Domain\Entities\Domain;

use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\FertilePeriodInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\MenstruationInterface;
use CicloMenstrual\Domain\Entities\Data\MenstrualCicle\Factories\FertilePeriodFactory;
use CicloMenstrual\Domain\Entities\MenstrualCicle\FertilePeriodCalculator;
use DateInterval;
use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FertilePeriodCalculatorTest extends TestCase
{
    private FertilePeriodCalculator $instance;
    private MockObject|MenstruationInterface $menstruationMock;
    private MockObject|FertilePeriodFactory $fertilePeriodFactoryMock;
    private MockObject|FertilePeriodInterface $fertilePeriodMock;

    public function setUp(): void
    {
        $this->menstruationMock = $this->createMock(MenstruationInterface::class);
        $this->fertilePeriodFactoryMock = $this->createMock(FertilePeriodFactory::class);
        $this->fertilePeriodMock = $this->createMock(FertilePeriodInterface::class);
        $this->instance = new FertilePeriodCalculator($this->fertilePeriodFactoryMock);
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

        $this->menstruationMock
            ->expects($this->once())
            ->method('getInitialDate')
            ->willReturn($initialDateMenstruation);

        $this->fertilePeriodFactoryMock
            ->expects($this->once())
            ->method('create')
            ->with([$initialDate, $initialDate->add($endDateInterval)])
            ->willReturn($this->fertilePeriodMock);
        
        $result = $this->instance->calculate($this->menstruationMock);

        $this->assertEquals($this->fertilePeriodMock, $result);
    }
}
<?php

namespace Tests\Domain\MenstrualCalendar\UseCases;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\FertilePeriodData;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\MenstruationData;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Factories\FertilePeriodFactory;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Factories\LutealPhaseFactory;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Factories\MenstruationFactory;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\FertilePeriod;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Menstruation;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\MenstruationDate;
use CicloMenstrual\Domain\MenstrualCalendar\UseCases\GetMenstrualCalendar;
use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GetMenstrualCalendarTest extends TestCase
{
    private GetMenstrualCalendar $instance;
    private MockObject|MenstruationDate $menstruationDateMock;
    private MockObject|MenstruationFactory $menstruationFactoryMock;
    private MockObject|FertilePeriodFactory $fertilePeriodFactoryMock;
    private MockObject|LutealPhaseFactory $lutealPhaseFactoryMock;
    private MockObject|Menstruation $menstruationMock;
    private MockObject|MenstruationData $menstruationDataMock;
    private MockObject|FertilePeriod $fertilePeriodMock;
    private MockObject|FertilePeriodData $fertilePeriodDataMock;

    public function setUp(): void
    {
        $this->setMocks();
        $this->setInstance();
    }

    private function setMocks(): void
    {
        $this->menstruationDateMock = $this->createMock(MenstruationDate::class);
        $this->menstruationFactoryMock = $this->createMock(MenstruationFactory::class);
        $this->fertilePeriodFactoryMock = $this->createMock(FertilePeriodFactory::class);
        $this->lutealPhaseFactoryMock = $this->createMock(LutealPhaseFactory::class);
        $this->menstruationMock = $this->createMock(Menstruation::class);
        $this->menstruationDataMock = $this->createMock(MenstruationData::class);
        $this->fertilePeriodDataMock = $this->createMock(FertilePeriodData:::class);

    }

    private function setInstance(): void
    {
        /**
         * TODO: FInalizar test unitario, e fazer teste unitarios das factories
         */
        $this->instance = new GetMenstrualCalendar(
            $this->menstruationFactoryMock,
            $this->fertilePeriodFactoryMock,
            $this->lutealPhaseFactoryMock
        );
    }

    public function testExecute(
        DateTimeImmutable $initialMenstruationDate
    ): void {
        $this->menstruationDateMock
            ->expects($this->once())
            ->method('getInitial')
            ->willReturn($initialMenstruationDate);

        $this->menstruationFactoryMock
            ->expects($this->exactly(3))
            ->method('create')
            ->willReturn($this->menstruationMock);

        $this->menstruationMock
            ->expects($this->exactly(3))
            ->method('calculate')
            ->willReturnSelf();
        
        $this->menstruationMock
            ->expects($this->exactly(3))
            ->method('getData')
            ->willReturn($this->menstruationDataMock);

        $this->fertilePeriodFactoryMock
            ->expects($this->exactly(3))
            ->method('create')
            ->willReturn($this->fertilePeriodMock);

        $this->fertilePeriodMock
            ->expects($this->exactly(3))
            ->method('calculate')
            ->willReturnSelf();
        
        $this->fertilePeriodMock
            ->expects($this->exactly(3))
            ->method('getData')
            ->willReturn($this->fertilePeriodDataMock);

        

        /** TODO: Continuar testes unitarios */
        
        $this->instance->execute($this->menstruationDateMock);
        $this->assertEquals(true, true);
    }
}

<?php

namespace Tests\Domain\MenstrualCalendar\UseCases;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\FertilePeriodData;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\LutealPhaseData;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\MenstruationData;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Factories\FertilePeriodFactory;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Factories\LutealPhaseFactory;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Factories\MenstruationFactory;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\FertilePeriod;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\LutealPhase;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Menstruation;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\MenstruationDate;
use CicloMenstrual\Domain\MenstrualCalendar\UseCases\GetMenstrualCalendar;
use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GetMenstrualCalendarTest extends TestCase
{
    private GetMenstrualCalendar            $instance;
    private MockObject|MenstruationDate     $menstruationDateMock;
    private MockObject|MenstruationFactory  $menstruationFactoryMock;
    private MockObject|FertilePeriodFactory $fertilePeriodFactoryMock;
    private MockObject|LutealPhaseFactory   $lutealPhaseFactoryMock;
    private MockObject|LutealPhase          $lutealPhaseMock;
    private MockObject|LutealPhaseData      $lutealPhaseDataMock;
    private MockObject|Menstruation         $menstruationMock;
    private MockObject|MenstruationData     $menstruationDataMock;
    private MockObject|FertilePeriod        $fertilePeriodMock;
    private MockObject|FertilePeriodData    $fertilePeriodDataMock;

    /**
     * Set up method
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->setMocks();
        $this->setInstance();
    }

    /**
     * Set mocks
     *
     * @return void
     */
    private function setMocks(): void
    {
        $this->menstruationDateMock     = $this->createMock(MenstruationDate::class);
        $this->menstruationFactoryMock  = $this->createMock(MenstruationFactory::class);
        $this->fertilePeriodFactoryMock = $this->createMock(FertilePeriodFactory::class);
        $this->fertilePeriodMock        = $this->createMock(FertilePeriod::class);
        $this->lutealPhaseFactoryMock   = $this->createMock(LutealPhaseFactory::class);
        $this->lutealPhaseMock          = $this->createMock(LutealPhase::class);
        $this->lutealPhaseDataMock      = $this->createMock(LutealPhaseData::class);
        $this->menstruationMock         = $this->createMock(Menstruation::class);
        $this->menstruationDataMock     = $this->createMock(MenstruationData::class);
        $this->fertilePeriodDataMock    = $this->createMock(FertilePeriodData::class);
    }

    /**
     * Set instance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new GetMenstrualCalendar(
            $this->menstruationFactoryMock,
            $this->fertilePeriodFactoryMock,
            $this->lutealPhaseFactoryMock
        );
    }

    /**
     * Test execute
     *
     * @return void
     */
    public function testExecute(): void {
        $this->menstruationDateMock
            ->expects($this->once())
            ->method('getInitial')
            ->willReturn(new DateTimeImmutable());

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

        $this->lutealPhaseFactoryMock
            ->expects($this->exactly(3))
            ->method('create')
            ->willReturn($this->lutealPhaseMock);

        $this->lutealPhaseMock
            ->expects($this->exactly(3))
            ->method('calculate')
            ->willReturnSelf();

        $this->lutealPhaseMock
            ->expects($this->exactly(3))
            ->method('getData')
            ->willReturn($this->lutealPhaseDataMock);


        $this->menstruationDateMock
            ->expects($this->exactly(3))
            ->method('setInitial')
            ->willReturnSelf();
    

        $this->assertEquals(
            [
                0 => [
                    'menstruation'      => $this->menstruationDataMock,
                    'fertile_period'    => $this->fertilePeriodDataMock,
                    'luteal_phase'      => $this->lutealPhaseDataMock
                ],
                1 => [
                    'menstruation'      => $this->menstruationDataMock,
                    'fertile_period'    => $this->fertilePeriodDataMock,
                    'luteal_phase'      => $this->lutealPhaseDataMock
                ],
                2 => [
                    'menstruation'      => $this->menstruationDataMock,
                    'fertile_period'    => $this->fertilePeriodDataMock,
                    'luteal_phase'      => $this->lutealPhaseDataMock
                ],

            ],
            $this->instance->execute($this->menstruationDateMock)
        );
    }
}

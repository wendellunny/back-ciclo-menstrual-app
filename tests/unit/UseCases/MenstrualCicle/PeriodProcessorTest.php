<?php

namespace Tests\UseCases\MenstrualCicle;

use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\LutealPhaseInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicleInterface;
use CicloMenstrual\UseCases\Api\MenstrualCicle\Data\PeriodInterface;
use CicloMenstrual\UseCases\MenstrualCicle\Data\Period;
use CicloMenstrual\UseCases\MenstrualCicle\MenstrualCicleProcessor;
use CicloMenstrual\UseCases\MenstrualCicle\PeriodProcessor;
use DateInterval;
use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class PeriodProcessorTest extends TestCase
{
    private PeriodProcessor $instance;
    private MockObject|MenstrualCicleProcessor $menstrualCicleProcessorMock;
    private MockObject|PeriodInterface $periodMock;
    private MockObject|MenstrualCicleInterface $menstrualCicleMock;
    private MockObject|LutealPhaseInterface $lutealPhaseMock;

    /**
     * Set up method
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->menstrualCicleProcessorMock = $this->createMock(MenstrualCicleProcessor::class);
        $this->periodMock = $this->createMock(Period::class);
        $this->menstrualCicleMock = $this->createMock(MenstrualCicleInterface::class);
        $this->lutealPhaseMock = $this->createMock(LutealPhaseInterface::class);
        $this->instance = new PeriodProcessor($this->menstrualCicleProcessorMock);
    }

    /**
     * @test
     *
     * @return void
     */
    public function testProcess(): void
    {
        $initialDate = DateTimeImmutable::createFromFormat('d/m/Y', '12/09/2023');
        $finalDate = DateTimeImmutable::createFromFormat('d/m/Y', '12/12/2023');
        $ciclesQuantity = floor($initialDate->diff($finalDate)->days/28);
        $menstrualCicles = [];

        $this->periodMock->expects($this->exactly(2))
            ->method('getInitial')
            ->willReturn($initialDate);

        $this->periodMock->expects($this->once())
            ->method('getFinal')
            ->willReturn($finalDate);

        $this->menstrualCicleProcessorMock
            ->expects($this->exactly($ciclesQuantity))
            ->method('process')
            ->willReturn($this->menstrualCicleMock);

        $this->menstrualCicleMock
            ->expects($this->exactly($ciclesQuantity))
            ->method('getLutealPhase')
            ->willReturn($this->lutealPhaseMock);
        
        $this->lutealPhaseMock
            ->expects($this->exactly($ciclesQuantity))
            ->method('getEndDate')
            ->willReturn(DateTimeImmutable::createFromFormat('d/m/Y', '12/12/2023'));

        for ($i=0; $i < $ciclesQuantity; $i++) {
            $menstrualCicles[] = $this->menstrualCicleMock;
        }
        
        $result = $this->instance->process($this->periodMock);

        $this->assertEquals($menstrualCicles, $result);
    }
}
<?php

namespace Tests\Domain\MenstrualCalendar\Entities;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\FertilePeriodData;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\LutealPhaseData;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\LutealPhase;
use CicloMenstrual\Domain\MenstrualCalendar\Exception\EntityException;
use DateInterval;
use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class LutealPhaseTest extends TestCase
{
    private LutealPhase                     $instance;
    private MockObject|FertilePeriodData    $fertilePeriodDataMock;
    
    public function setUp(): void
    {
        $this->setMocks();
        $this->setInstance();
    }

    private function setMocks(): void
    {
        $this->fertilePeriodDataMock = $this->createMock(FertilePeriodData::class);
    }

    private function setInstance(): void
    {
        $this->instance = new LutealPhase();
    }

      /**
     * @test testCalculate
     * @dataProvider calculateDataProvider
     *
     * @param DateTimeImmutable $fertilePeriodEndDate
     * @param DateTimeImmutable $initialDate
     * @param DateTimeImmutable $endDate
     * @return void
     */
    public function testCalculate (
        DateTimeImmutable $fertilePeriodEndDate,
        DateTimeImmutable $initialDate,
        DateTimeImmutable $endDate
    ): void {

        $this->fertilePeriodDataMock
            ->expects($this->once())
            ->method('getEndDate')
            ->willReturn($fertilePeriodEndDate);

        $lutealPhaseData = new LutealPhaseData($initialDate, $endDate);

        $this->assertEquals(
            $this->instance,
            $this->instance->calculate($this->fertilePeriodDataMock)
        );

        $this->assertEquals(
            $lutealPhaseData,
            $this->instance->getData()
        );
        
    }

    /**
     * @test
     *
     * @return void
     */
    public function testGetDataWithoutBeforeCalculate(): void
    {
        $this->expectException(EntityException::class);
        $this->expectExceptionMessage('Before must calculate luteal phase');

        $this->instance->getData();
    }

    /**
     * Calculate data provider
     *
     * @return array
     */
    public static function calculateDataProvider(): array
    {
        return [
            'whenSuccess' => [
                'fertilePeriodEndDate' => $fertilePeriodEndDate = new DateTimeImmutable('2023-11-15'),
                'initialDate' => $initialDate =  $fertilePeriodEndDate->add(
                    DateInterval::createFromDateString('1 day')
                ),
                'endDate' => $initialDate->add(
                    DateInterval::createFromDateString('9 days')
                )
            ]
        ];
    }
}
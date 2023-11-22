<?php

namespace Tests\Domain\MenstrualCalendar\Entities;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\FertilePeriodData;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\MenstruationData;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\FertilePeriod;
use CicloMenstrual\Domain\MenstrualCalendar\Exception\EntityException;
use DateInterval;
use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FertilePeriodTest extends TestCase
{

    private FertilePeriod               $instance;
    private MockObject|MenstruationData $menstruationDataMock;

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
        $this->menstruationDataMock = $this->createMock(MenstruationData::class);
    }

    /**
     * Set instance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new FertilePeriod();
    }

    /**
     * @test testCalculate
     * @dataProvider calculateDataProvider
     *
     * @param DateTimeImmutable $menstruationInitialDate
     * @param DateTimeImmutable $initialDate
     * @param DateTimeImmutable $endDate
     * @return void
     */
    public function testCalculate (
        DateTimeImmutable $menstruationInitialDate,
        DateTimeImmutable $initialDate,
        DateTimeImmutable $endDate
    ): void {

        $this->menstruationDataMock
            ->expects($this->once())
            ->method('getInitialDate')
            ->willReturn($menstruationInitialDate);

        $fertilePeriodData = new FertilePeriodData($initialDate, $endDate);

        $this->assertEquals(
            $this->instance,
            $this->instance->calculate($this->menstruationDataMock)
        );

        $this->assertEquals(
            $fertilePeriodData,
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
        $this->expectExceptionMessage('Before must calculate fertile period');

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
                'menstruationInitialDate' => $menstruationInitialDate = new DateTimeImmutable('2023-11-14'),
                'initialDate' => $initialDate =  $menstruationInitialDate->add(
                    DateInterval::createFromDateString('14 days')
                ),
                'endDate' => $initialDate->add(
                    DateInterval::createFromDateString('5 days')
                )
            ]
        ];
    }
}
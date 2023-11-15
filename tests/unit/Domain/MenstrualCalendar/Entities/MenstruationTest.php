<?php

namespace Tests\Domain\MenstrualCalendar\Entities;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\MenstruationData;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Menstruation;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\MenstruationDate;
use CicloMenstrual\Domain\MenstrualCalendar\Exception\EntityException;
use DateInterval;
use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MenstruationTest extends TestCase
{
    private Menstruation $instance;
    private MockObject|MenstruationDate $menstruationDateMock;


    public function setUp(): void
    {
        $this->setMocks();
        $this->setInstance();
    }

    private function setMocks(): void
    {
        $this->menstruationDateMock = $this->createMock(MenstruationDate::class);
    }

    private function setInstance(): void
    {
        $this->instance = new Menstruation();
    }

     /**
     * @test testCalculate
     * @dataProvider calculateDataProvider
     * 
     * @param DateTimeImmutable $initialDate
     * @param DateTimeImmutable $endDate
     * @return void
     */
    public function testCalculate (
        DateTimeImmutable $initialDate,
        DateTimeImmutable $endDate
    ): void {
        $this->menstruationDateMock
            ->expects($this->exactly(2))
            ->method('getInitial')
            ->willReturn($initialDate);

        $menstruationData = new MenstruationData($initialDate, $endDate);

        $this->assertEquals(
            $this->instance,
            $this->instance->calculate($this->menstruationDateMock)
        );

        $this->assertEquals(
            $menstruationData,
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
        $this->expectExceptionMessage('Before must calculate menstruation');

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
                'initialDate' => $initialDate = new DateTimeImmutable('2023-11-15'),
                'endDate' => $initialDate->add(
                    DateInterval::createFromDateString('5 days')
                )
            ]
        ];
    }
    
}

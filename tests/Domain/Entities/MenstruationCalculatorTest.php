<?php

namespace Tests\Domain\Entities;

use CicloMenstrual\Domain\Api\Entities\Data\MenstruationInterface;
use CicloMenstrual\Domain\Entities\Data\Factories\MenstruationFactory;
use CicloMenstrual\Domain\Entities\Data\Menstruation;
use CicloMenstrual\Domain\Entities\MenstruationCalculator;
use DateInterval;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class MenstruationCalculatorTest extends TestCase
{
    /**
     * @var MenstruationCalculator
     */
    private MenstruationCalculator $instance;

    private MenstruationFactory $menstruationFactoryMock;

    private MenstruationInterface $menstruationMock;
    
    /**
     * Setup method
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->menstruationFactoryMock = $this->createMock(MenstruationFactory::class);
        $this->menstruationMock = $this->createMock(MenstruationInterface::class);
        $this->instance = new MenstruationCalculator($this->menstruationFactoryMock);
    }

    /**
     * @test
     *
     * @return void
     */
    public function testCalculate(): void
    {
        $date = new DateTimeImmutable();
        $dateInterval = DateInterval::createFromDateString('5 days');

        $this->menstruationFactoryMock
            ->expects($this->once())
            ->method('create')
            ->with([$date, $date->add($dateInterval)])
            ->willReturn($this->menstruationMock);
        
        
        $result = $this->instance->calculate($date);

        $this->assertEquals($this->menstruationMock, $result);
    }
}
<?php

namespace Tests\UseCases\MenstrualCalendar;

use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;
use CicloMenstrual\UseCases\Api\Authentication\Session\LoggedSessionInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\Data\UserMenstrualDateInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualDateRepositoryInterface;
use CicloMenstrual\UseCases\Api\MenstrualCicle\PeriodProcessorInterface;
use CicloMenstrual\UseCases\MenstrualCalendar\MenstrualCalendar;
use CicloMenstrual\UseCases\MenstrualCicle\Data\Period;
use DateInterval;
use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MenstrualCalendarTest extends TestCase
{
    private MenstrualCalendar $instance;
    private MockObject|PeriodProcessorInterface $periodProcessorMock;
    private MockObject|LoggedSessionInterface $loggedSessionMock;
    private MockObject|MenstrualDateRepositoryInterface $menstrualDateRepositoryMock;
    private MockObject|UserMenstrualDateInterface $userMenstrualDateMock;
    private MockObject|UserInterface $userMock;

    /**
     * Setup method
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->periodProcessorMock = $this->createMock(PeriodProcessorInterface::class);
        $this->loggedSessionMock = $this->createMock(LoggedSessionInterface::class);
        $this->menstrualDateRepositoryMock = $this->createMock(MenstrualDateRepositoryInterface::class);
        $this->userMenstrualDateMock = $this->createMock(UserMenstrualDateInterface::class);
        $this->userMock = $this->createMock(UserInterface::class);

        $this->instance = new MenstrualCalendar(
            $this->periodProcessorMock,
            $this->loggedSessionMock,
            $this->menstrualDateRepositoryMock
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function testExecute(): void
    {
        $this->loggedSessionMock
            ->expects($this->once())
            ->method('getUser')
            ->willReturn($this->userMock);

        $this->menstrualDateRepositoryMock
            ->expects($this->once())
            ->method('loadLastMenstrualDateByUser')
            ->with($this->userMock)
            ->willReturn($this->userMenstrualDateMock);

        $date = '2023-09-27';
        $this->userMenstrualDateMock
            ->expects($this->once())
            ->method('getDate')
            ->willReturn($date);
        
        $startDate = new DateTimeImmutable($date);
        $dateInterval = DateInterval::createFromDateString('12 months');
        $endDate = $startDate->add($dateInterval);

        $period = new Period($startDate, $endDate);

        $this->periodProcessorMock
            ->expects($this->once())
            ->method('process')
            ->with($period)
            ->willReturn(['periodo1', 'period2']);

        $this->instance->execute();
    }
}
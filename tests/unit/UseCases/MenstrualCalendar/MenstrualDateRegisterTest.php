<?php

namespace Tests\UseCases\MenstrualCalendar;

use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;
use CicloMenstrual\UseCases\Api\Authentication\Session\LoggedSessionInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\Data\UserMenstrualDateInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualDateRepositoryInterface;
use CicloMenstrual\UseCases\MenstrualCalendar\Data\UserMenstrualDate;
use CicloMenstrual\UseCases\MenstrualCalendar\Data\UserMenstrualDateFactory;
use CicloMenstrual\UseCases\MenstrualCalendar\MenstrualDateRegister;
use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MenstrualDateRegisterTest extends TestCase
{

    private MenstrualDateRegister $instance;
    private MockObject|LoggedSessionInterface $loggedSessionMock;
    private MockObject|MenstrualDateRepositoryInterface $menstrualDateRespositoryMock;
    private MockObject|UserMenstrualDateFactory $userMenstrualDateFactoryMock;
    private MockObject|UserInterface $userMock;
    private MockObject|UserMenstrualDateInterface $userMenstrualDateMock;

    /**
     * Setup method
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->loggedSessionMock = $this->createMock(LoggedSessionInterface::class);
        $this->menstrualDateRespositoryMock = $this->createMock(MenstrualDateRepositoryInterface::class);
        $this->userMenstrualDateFactoryMock = $this->createMock(UserMenstrualDateFactory::class);
        $this->userMock = $this->createMock(UserInterface::class);
        $this->userMenstrualDateMock = $this->createMock(UserMenstrualDate::class);

        $this->instance = new MenstrualDateRegister(
            $this->loggedSessionMock,
            $this->menstrualDateRespositoryMock,
            $this->userMenstrualDateFactoryMock
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function testExecute(): void
    {
        $lastMenstruationDate = new DateTimeImmutable('2023-09-27');

        $this->loggedSessionMock
            ->expects($this->once())
            ->method('getUser')
            ->willReturn($this->userMock);

        $this->userMock
            ->expects($this->once())
            ->method('getuuid')
            ->willReturn('uuid-de-teste');

        $this->userMenstrualDateFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->userMenstrualDateMock);

        $this->menstrualDateRespositoryMock
            ->expects($this->once())
            ->method('save')
            ->with($this->userMenstrualDateMock)
            ->willReturn(true);
        
        $this->instance->execute($lastMenstruationDate);
    }
}
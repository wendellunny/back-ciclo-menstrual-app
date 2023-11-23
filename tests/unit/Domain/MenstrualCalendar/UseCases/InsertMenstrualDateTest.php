<?php

namespace Tests\Domain\MenstrualCalendar\UseCases;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\MenstruationDate;
use CicloMenstrual\Domain\MenstrualCalendar\Repositories\MenstrualDateRepositoryInterface;
use CicloMenstrual\Domain\MenstrualCalendar\UseCases\InsertMenstrualDate;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class InsertMenstrualDateTest extends TestCase
{
    private InsertMenstrualDate                             $instance;
    private MockObject|MenstrualDateRepositoryInterface     $repositoryMock;
    private MockObject|MenstruationDate                     $menstruationDateMock;

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
        $this->repositoryMock       = $this->createMock(MenstrualDateRepositoryInterface::class);
        $this->menstruationDateMock = $this->createMock(MenstruationDate::class);
    }

    /**
     * Set instance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new InsertMenstrualDate($this->repositoryMock);
    }

    /**
     * Test execute
     *
     * @return void
     */
    public function testExecute(): void
    {
        $this->repositoryMock
            ->expects($this->once())
            ->method('save')
            ->with($this->menstruationDateMock)
            ->willReturn(true);

        $this->assertEquals(
            $this->menstruationDateMock,
            $this->instance->execute($this->menstruationDateMock)
        );
    }
}
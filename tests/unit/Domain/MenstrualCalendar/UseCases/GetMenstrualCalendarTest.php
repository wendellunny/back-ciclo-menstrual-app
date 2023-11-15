<?php

namespace Tests\Domain\MenstrualCalendar\UseCases;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\MenstruationDate;
use CicloMenstrual\Domain\MenstrualCalendar\UseCases\GetMenstrualCalendar;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GetMenstrualCalendarTest extends TestCase
{
    private GetMenstrualCalendar $instance;
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
        /**
         * TODO: FInalizar test unitario, e fazer teste unitarios das factories
         */
        $this->instance = new GetMenstrualCalendar();
    }

    public function testExecute(): void
    {
        
        $this->instance->execute($this->menstruationDateMock);
        $this->assertEquals(true, true);
    }
}

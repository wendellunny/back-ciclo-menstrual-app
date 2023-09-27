<?php

namespace CicloMenstrual\UseCases\Api\MenstrualCalendar;

use DateTimeImmutable;

interface MenstrualDateRegisterInterface
{
    /**
     * Execute method
     *
     * @param DateTimeImmutable $date
     * @return boolean
     */
    public function execute(DateTimeImmutable $lastMenstruationDate): bool;
}
<?php

namespace CicloMenstrual\Domain\Entities;

use CicloMenstrual\Domain\Api\Entities\Data\MenstruationInterface;
use CicloMenstrual\Domain\Entities\Data\Menstruation;
use DateInterval;
use DateTimeImmutable;

class MenstruationCalculator
{
    /**
     * Calculate menstruation day
     *
     * @param integer $initialDay
     * @return array
     */
    public function calculate(DateTimeImmutable $initialDate): MenstruationInterface
    {
        $dateInterval = DateInterval::createFromDateString('5 days');
        $endDate = $initialDate->add($dateInterval);

        return new Menstruation($initialDate, $endDate);
    }
}
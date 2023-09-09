<?php

namespace CicloMenstrual\Domain\Entities;

use CicloMenstrual\Domain\Api\Entities\Data\MenstruationInterface;
use CicloMenstrual\Domain\Entities\Data\Menstruation;
use DateInterval;
use DateTime;

class MenstruationCalculator
{
    /**
     * Calculate menstruation day
     *
     * @param integer $initialDay
     * @return array
     */
    public function calculate(DateTime $initialDate): MenstruationInterface
    {
        $dateInterval = DateInterval::createFromDateString('5 days');
        $endDate = $initialDate->add($dateInterval);

        return new Menstruation($initialDate, $endDate);
    }
}
<?php

namespace CicloMenstrual\Domain\Entities;

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
    public function calculate(DateTime $initialDate): array
    {
        $dateInterval = DateInterval::createFromDateString('5 days');
        $endDate = $initialDate->add($dateInterval);

        return [
            'final_date' => $endDate,
        ];
    }
}
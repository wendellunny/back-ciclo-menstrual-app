<?php

namespace CicloMenstrual\Domain\Entities;

use CicloMenstrual\Domain\Api\Entities\Data\MenstruationInterface;
use DateInterval;

class FertilePeriodCalculator
{
    /**
     * Calculate
     *
     * @param MenstruationInterface $menstruation
     * @return array
     */
    public function calculate(MenstruationInterface $menstruation): array
    {
        $initialDateInterval = DateInterval::createFromDateString('14 days');
        $initialDate = $menstruation->getInitialDate()->add($initialDateInterval);
        $endDateInterval = DateInterval::createFromDateString('5 days');
        $endDate = $initialDate->add($endDateInterval);

        return [
            'initial_date' => $initialDate,
            'end_date' => $endDate
        ];
    }
}
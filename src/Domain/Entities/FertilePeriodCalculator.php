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
        $initalDate = $menstruation->getInitialDate();
        $dateInterval = DateInterval::createFromDateString('14 days');
        $endDate = $initalDate->add($dateInterval);

        return [
            'initial_date' => $initalDate,
            'end_date' => $endDate
        ];
    }
}
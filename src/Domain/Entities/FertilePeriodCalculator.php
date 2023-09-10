<?php

namespace CicloMenstrual\Domain\Entities;

use CicloMenstrual\Domain\Api\Entities\Data\FertilePeriodInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstruationInterface;
use CicloMenstrual\Domain\Entities\Data\FertilePeriod;
use DateInterval;

class FertilePeriodCalculator
{
    /**
     * Calculate
     *
     * @param MenstruationInterface $menstruation
     * @return FertilePeriodInterface
     */
    public function calculate(MenstruationInterface $menstruation): FertilePeriodInterface
    {
        $initialDateInterval = DateInterval::createFromDateString('14 days');
        $initialDate = $menstruation->getInitialDate()->add($initialDateInterval);
        $endDateInterval = DateInterval::createFromDateString('5 days');
        $endDate = $initialDate->add($endDateInterval);

        return new FertilePeriod($initialDate, $endDate);
    }
}
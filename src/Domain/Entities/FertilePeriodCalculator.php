<?php

namespace CicloMenstrual\Domain\Entities;

use CicloMenstrual\Domain\Api\Entities\Data\FertilePeriodInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstruationInterface;
use CicloMenstrual\Domain\Entities\Data\Factories\FertilePeriodFactory;
use CicloMenstrual\Domain\Entities\Data\FertilePeriod;
use DateInterval;

class FertilePeriodCalculator
{
    public function __construct(private FertilePeriodFactory $fertilePeriodFactory)
    {
    }

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

        return $this->fertilePeriodFactory->create([$initialDate, $endDate]);
    }
}
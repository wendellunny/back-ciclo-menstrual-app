<?php

namespace CicloMenstrual\Domain\Entities\MenstrualCicle;

use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\FertilePeriodInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\MenstruationInterface;
use CicloMenstrual\Domain\Entities\Data\MenstrualCicle\Factories\FertilePeriodFactory;
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
        $initialDate = $menstruation->getInitialDate()->add(
            DateInterval::createFromDateString('14 days')
        );

        $endDate = $initialDate->add(
            DateInterval::createFromDateString('5 days')
        );

        return $this->fertilePeriodFactory->create([$initialDate, $endDate]);
    }
}
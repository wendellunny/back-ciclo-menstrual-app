<?php

namespace CicloMenstrual\Domain\Entities\MenstrualCicle;

use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\FertilePeriodInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\LutealPhaseInterface;
use CicloMenstrual\Domain\Entities\Data\MenstrualCicle\Factories\LutealPhaseFactory;
use DateInterval;

class LutealPhaseCalculator
{
    public function __construct(private LutealPhaseFactory $lutealPhaseFactory)
    {
    }
    
    public function calculate(FertilePeriodInterface $fertilePeriod): LutealPhaseInterface
    {
        $initialDate = $fertilePeriod->getEndDate()->add(
            DateInterval::createFromDateString('1 day')
        );

        $endDate = $initialDate->add(
            DateInterval::createFromDateString('9 days')
        );

        return $this->lutealPhaseFactory->create([$initialDate, $endDate]);
    }
}
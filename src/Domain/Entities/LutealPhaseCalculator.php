<?php

namespace CicloMenstrual\Domain\Entities;

use CicloMenstrual\Domain\Api\Entities\Data\FertilePeriodInterface;
use CicloMenstrual\Domain\Api\Entities\Data\LutealPhaseInterface;
use CicloMenstrual\Domain\Entities\Data\Factories\LutealPhaseFactory;
use DateInterval;

class LutealPhaseCalculator
{
    public function __construct(private LutealPhaseFactory $lutealPhaseFactory)
    {
    }
    
    public function calculate(FertilePeriodInterface $fertilePeriod): LutealPhaseInterface
    {
        $initialDate = $fertilePeriod->getEndDate();
        
        $endDate = $initialDate->add(
            DateInterval::createFromDateString('9 days')
        );

        return $this->lutealPhaseFactory->create([$initialDate, $endDate]);
    }
}
<?php

namespace CicloMenstrual\Domain\Entities;

use CicloMenstrual\Domain\Api\Entities\Data\FertilePeriodInterface;
use CicloMenstrual\Domain\Api\Entities\Data\LutealPhaseInterface;
use CicloMenstrual\Domain\Entities\Data\LutealPhase;
use DateInterval;

class LutealPhaseCalculator
{
    public function calculate(FertilePeriodInterface $fertilePeriod): LutealPhaseInterface
    {
        $initialDate = $fertilePeriod->getEndDate();
        $dateInterval = DateInterval::createFromDateString('9 days');
        $endDate = $initialDate->add($dateInterval);

        return new LutealPhase(
            $initialDate,
            $endDate
        );
    }
}
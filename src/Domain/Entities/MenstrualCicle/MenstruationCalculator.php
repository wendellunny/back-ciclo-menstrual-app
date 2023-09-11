<?php

namespace CicloMenstrual\Domain\Entities\MenstrualCicle;

use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\MenstruationInterface;
use CicloMenstrual\Domain\Entities\Data\MenstrualCicle\Factories\MenstruationFactory;
use DateInterval;
use DateTimeImmutable;

class MenstruationCalculator
{
    public function __construct(private MenstruationFactory $menstruationFactory)
    {
        
    }
    /**
     * Calculate menstruation day
     *
     * @param integer $initialDay
     * @return array
     */
    public function calculate(DateTimeImmutable $initialDate): MenstruationInterface
    {
        $endDate = $initialDate->add(
            DateInterval::createFromDateString('5 days')
        );

        return $this->menstruationFactory->create([$initialDate,$endDate]);
    }
}
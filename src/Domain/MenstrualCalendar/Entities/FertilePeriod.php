<?php

namespace CicloMenstrual\Domain\MenstrualCalendar\Entities;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\FertilePeriodData;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\MenstruationData;
use CicloMenstrual\Domain\MenstrualCalendar\Exception\EntityException;
use DateInterval;

/**
 * Fertile period entity
 */
class FertilePeriod
{
    /**
     * Fertile period data
     *
     * @var FertilePeriodData
     */
    private FertilePeriodData $data;

    /**
     * Calculate
     *
     * @param MenstruationData $menstruationData
     * @return self
     */
    public function calculate(MenstruationData $menstruationData): self
    {
        $initialDate = $menstruationData->getInitialDate()->add(
            DateInterval::createFromDateString('14 days')
        );

        $endDate = $initialDate->add(
            DateInterval::createFromDateString('5 days')
        );
        
        $this->data = new FertilePeriodData($initialDate, $endDate);

        return $this;
    }

    /**
    * Get data
    *
    * @return FertilePeriodData
    */
    public function getData(): FertilePeriodData
    {
        if(!isset($this->data)) {
            throw new EntityException('Before must calculate fertile period');
        }
        
        return $this->data;
    }
}

<?php

namespace CicloMenstrual\Domain\MenstrualCalendar\Entities;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\FertilePeriodData;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\LutealPhaseData;
use CicloMenstrual\Domain\MenstrualCalendar\Exception\EntityException;
use DateInterval;

class LutealPhase
{

    /**
     * Luteal phase data
     *
     * @var LutealPhaseData
     */
    private LutealPhaseData $data;

    /**
     * Calculate
     *
     * @param FertilePeriodData $fertilePeriodData
     * @return self
     */
    public function calculate(FertilePeriodData $fertilePeriodData): self
    {
        $initialDate = $fertilePeriodData->getEndDate()->add(
            DateInterval::createFromDateString('1 day')
        );

        $endDate = $initialDate->add(
            DateInterval::createFromDateString('9 days')
        );
        
        $this->data = new LutealPhaseData($initialDate, $endDate);

        return $this;
    }

    /**
     * Get data
     *
     * @return LutealPhaseData
     */
    public function getData(): LutealPhaseData
    {
        if(!isset($this->data)) {
            throw new EntityException('Before must calculate luteal phase');
        }
        
        return $this->data;
    }
}
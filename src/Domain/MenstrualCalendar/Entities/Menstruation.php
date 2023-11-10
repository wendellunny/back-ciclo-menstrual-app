<?php

namespace CicloMenstrual\Domain\MenstrualCalendar\Entities;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\MenstruationData;
use CicloMenstrual\Domain\MenstrualCalendar\Exception\EntityException;
use DateInterval;

class Menstruation
{

    private MenstruationData $data;
    
    public function calculate(MenstruationDate $menstruationDate): self
    {
        $endDate = $menstruationDate->getInitial()->add(
            DateInterval::createFromDateString('5 days')
        );

        $this->data = new MenstruationData(
            $menstruationDate->getInitial(),
            $endDate
        );

        return $this;
    }

    /**
     * Get data
     *
     * @return MenstruationData
     */
    public function getData(): MenstruationData
    {
        if(!isset($this->data)) {
            throw new EntityException('Before must calculate menstruation');
        }
        
        return $this->data;
    }
}
<?php

namespace CicloMenstrual\Domain\MenstrualCalendar\Entities;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos\FertilePeriodData;

use DateInterval;

class FertilePeriod
{
  
    public function __construct(private ?FertilePeriodData $data = null)
    {
    }

    public function getData(): ?FertilePeriodData
    {
        return $this->data;
    }

    public function calculate($menstruation): self
    {
        $initialDate = $menstruation->getInitialDate()->add(
            DateInterval::createFromDateString('14 days')
        );

        $endDate = $initialDate->add(
            DateInterval::createFromDateString('5 days')
        );


        // TODO: continuar refatoração;
        return new FertilePeriod();
    }
}
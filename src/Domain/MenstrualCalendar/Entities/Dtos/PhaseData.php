<?php

namespace CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos;

use DateTimeImmutable;

class PhaseData
{
     /**
     * Constructor Method
     *
     * @param DateTimeImmutable $initialDate
     * @param DateTimeImmutable $endDate
     */
    public function __construct(
        protected DateTimeImmutable $initialDate,
        protected DateTimeImmutable $endDate
    ) {
    }

    /**
     * Get initial date
     *
     * @return DateTimeImmutable
     */
    public function getInitialDate(): DateTimeImmutable
    {
        return $this->initialDate;
    }

    /**
     * Get end date
     *
     * @return DateTimeImmutable
     */
    public function getEndDate(): DateTimeImmutable
    {
        return $this->endDate;
    }
}

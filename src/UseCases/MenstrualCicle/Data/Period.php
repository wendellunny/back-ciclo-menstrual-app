<?php

namespace CicloMenstrual\UseCases\MenstrualCicle\Data;

use CicloMenstrual\UseCases\Api\MenstrualCicle\Data\PeriodInterface;
use DateTimeImmutable;

class Period implements PeriodInterface
{
    public function __construct(
        private DateTimeImmutable $initialDate,
        private DateTimeImmutable $finalDate
    ) {
        
    }
    /**
     * Set initial
     *
     * @param DateTimeImmutable $date
     * @return self
     */
    public function setInitial(DateTimeImmutable $initialDate): self
    {
        $this->initialDate = $initialDate;
        return $this;
    }

    /**
     * Get initial
     *
     * @return DateTimeImmutable
     */
    public function getInitial(): DateTimeImmutable
    {
        return $this->initialDate;
    }

    /**
     * Set final
     *
     * @param DateTimeImmutable $date
     * @return void
     */
    public function setFinal(DateTimeImmutable $finalDate): self
    {
        $this->finalDate = $finalDate;
        return $this;
    }

    /**
     * Get final
     *
     * @return DateTimeImmutable
     */
    public function getFinal(): DateTimeImmutable
    {
        return $this->finalDate;
    }
}
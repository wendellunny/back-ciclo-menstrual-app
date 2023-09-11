<?php

namespace CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle;

use DateTimeImmutable;

interface LutealPhaseInterface
{
    /**
     * Set initial date
     *
     * @param DateTimeImmutable $initialDate
     * @return self
     */
    public function setInitialDate(DateTimeImmutable $initialDate): self;

    /**
     * Get initial date
     *
     * @return DateTimeImmutable
     */
    public function getInitialDate(): DateTimeImmutable;

    /**
     * Set end date
     *
     * @param DateTimeImmutable $endDate
     * @return self
     */
    public function setEndDate(DateTimeImmutable $endDate): self;

    /**
     * Get end date
     *
     * @return DateTimeImmutable
     */
    public function getEndDate(): DateTimeImmutable;
}
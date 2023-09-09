<?php

namespace CicloMenstrual\Domain\Api\Entities\Data;

use DateTime;
use DateTimeImmutable;

interface MenstruationInterface
{
    /**
     * Set initial date
     *
     * @param DateTime $initialDate
     * @return self
     */
    public function setInitialDate(DateTimeImmutable $initialDate): self;

    /**
     * Get initial date
     *
     * @return DateTime
     */
    public function getInitialDate(): DateTimeImmutable;

    /**
     * Set end date
     *
     * @param DateTime $endDate
     * @return self
     */
    public function setEndDate(DateTimeImmutable $endDate): self;

    /**
     * Get end date
     *
     * @return DateTime
     */
    public function getEndDate(): DateTimeImmutable;
}
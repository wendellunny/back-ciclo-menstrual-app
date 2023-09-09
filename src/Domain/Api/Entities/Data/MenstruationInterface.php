<?php

namespace CicloMenstrual\Domain\Api\Entities\Data;

use DateTime;

interface MenstruationInterface
{
    /**
     * Set initial date
     *
     * @param DateTime $initialDate
     * @return self
     */
    public function setInitialDate(DateTime $initialDate): self;

    /**
     * Get initial date
     *
     * @return DateTime
     */
    public function getInitialDate(): DateTime;

    /**
     * Set end date
     *
     * @param DateTime $endDate
     * @return self
     */
    public function setEndDate(DateTime $endDate): self;

    /**
     * Get end date
     *
     * @return DateTime
     */
    public function getEndDate(): DateTime;
}
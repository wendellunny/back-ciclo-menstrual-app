<?php

namespace CicloMenstrual\Domain\Entities\Data;

use CicloMenstrual\Domain\Api\Entities\Data\MenstruationInterface;
use DateTime;
use DateTimeImmutable;

class Menstruation implements MenstruationInterface
{
    public function __construct(
        private ?DateTimeImmutable $initialDate = null,
        private ?DateTimeImmutable $endDate = null
    ) {
    }

    /**
     * Set initial date
     *
     * @param DateTimeImmutable $initialDate
     * @return self
     */
    public function setInitialDate(DateTimeImmutable $initialDate): self
    {
        $this->initialDate = $initialDate;
        return $this;
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
     * Set end date
     *
     * @param DateTimeImmutable $endDate
     * @return self
     */
    public function setEndDate(DateTimeImmutable $endDate): self
    {
        $this->endDate = $endDate;
        return $this;
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
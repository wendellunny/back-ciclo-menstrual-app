<?php

namespace CicloMenstrual\Domain\Entities\Data;

use CicloMenstrual\Domain\Api\Entities\Data\MenstruationInterface;
use DateTime;

class Menstruation implements MenstruationInterface
{
    public function __construct(
        private ?DateTime $initialDate = null,
        private ?DateTime $endDate = null
    ) {
    }

    /**
     * Set initial date
     *
     * @param DateTime $initialDate
     * @return self
     */
    public function setInitialDate(DateTime $initialDate): self
    {
        $this->initialDate = $initialDate;
        return $this;
    }

    /**
     * Get initial date
     *
     * @return DateTime
     */
    public function getInitialDate(): DateTime
    {
        return $this->initialDate;
    }

    /**
     * Set end date
     *
     * @param DateTime $endDate
     * @return self
     */
    public function setEndDate(DateTime $endDate): self
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * Get end date
     *
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }
}
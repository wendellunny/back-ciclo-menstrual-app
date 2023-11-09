<?php

namespace CicloMenstrual\Domain\MenstrualCalendar\Entities;

use DateTimeImmutable;

/**
 * Menstrual date entity
 */
class MenstruationDate
{
    /**
     * Initial date
     *
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $initial;

    /**
     * Set Initial
     *
     * @param DateTimeImmutable $initial
     * @return self
     */
    public function setInitial(DateTimeImmutable $initial): self
    {
        $this->initial = $initial;
        return $this;
    }

    /**
     * Get Initial
     *
     * @return DateTimeImmutable
     */
    public function getInitial(): DateTimeImmutable
    {
        return $this->initial;
    }
}

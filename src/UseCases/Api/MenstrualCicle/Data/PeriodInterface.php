<?php

namespace CicloMenstrual\UseCases\Api\MenstrualCicle\Data;

use DateTimeImmutable;

interface PeriodInterface
{
    /**
     * Set initial
     *
     * @param DateTimeImmutable $initialDate
     * @return self
     */
    public function setInitial(DateTimeImmutable $initialDate): self;

    /**
     * Get initial
     *
     * @return DateTimeImmutable
     */
    public function getInitial(): DateTimeImmutable;

    /**
     * Set final
     *
     * @param DateTimeImmutable $finalDate
     * @return void
     */
    public function setFinal(DateTimeImmutable $finalDate): self;

    /**
     * Get final
     *
     * @return DateTimeImmutable
     */
    public function getFinal(): DateTimeImmutable;
}
<?php

namespace CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos;

use DateTimeImmutable;

/**
 * Fertile Period DTO
 */
class FertilePeriodData
{
    /**
     * Constructor Method
     *
     * @param DateTimeImmutable $initialDate
     * @param DateTimeImmutable $endDate
     */
    public function __construct(
        private DateTimeImmutable $initialDate,
        private DateTimeImmutable $endDate
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

    /**
     * Json serialize
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'initial_date' => date_format($this->initialDate, 'Y-m-d'),
            'end_date' => date_format($this->endDate, 'Y-m-d')
        ];
    }
}
<?php

namespace CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos;

use DateTimeImmutable;

/**
 * Fertile Period DTO
 */
class FertilePeriodData extends PhaseData
{
    /**
     * Json serialize
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'initial_date'  => date_format($this->initialDate, 'Y-m-d'),
            'end_date'      => date_format($this->endDate, 'Y-m-d')
        ];
    }
}
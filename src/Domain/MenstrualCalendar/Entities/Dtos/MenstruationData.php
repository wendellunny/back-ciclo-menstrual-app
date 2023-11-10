<?php

namespace CicloMenstrual\Domain\MenstrualCalendar\Entities\Dtos;

/**
 * Menstruation DTO
 */
class MenstruationData extends PhaseData
{
    /**
     * Json serialize
     *
     * @return mixed
     */
    public function jsonSerialize(): array
    {
        return [
            'initial_date' => date_format($this->initialDate, 'Y-m-d'),
            'end_date' => date_format($this->endDate, 'Y-m-d')
        ];
    }
}

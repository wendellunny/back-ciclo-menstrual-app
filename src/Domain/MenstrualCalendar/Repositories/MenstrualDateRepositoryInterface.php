<?php

namespace CicloMenstrual\Domain\MenstrualCalendar\Repositories;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\MenstruationDate;

/**
 * Menstrual date repository interface
 */
interface MenstrualDateRepositoryInterface
{
    /**
     * Save menstrual date repository
     *
     * @return bool
     */
    public function save(MenstruationDate $menstruationDate): bool;
}

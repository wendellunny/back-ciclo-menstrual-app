<?php

namespace CicloMenstrual\Domain\MenstrualCalendar\UseCases;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\MenstruationDate;

class InsertMenstrualDate
{
    /**
     * Execute
     *
     * @param MenstruationDate $lastMenstruationDate
     * @return boolean
     */
    public function execute(MenstruationDate $lastMenstruationDate): bool
    {
        /**
         * TODO: Implmentar Use Case de inserir ultima data de menstruação no banco
         */
        $lastMenstruationDate->getInitial();

        return true;
    }
}
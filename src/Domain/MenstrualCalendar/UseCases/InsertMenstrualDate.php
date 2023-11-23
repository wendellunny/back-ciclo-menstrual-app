<?php

namespace CicloMenstrual\Domain\MenstrualCalendar\UseCases;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\MenstruationDate;
use CicloMenstrual\Domain\MenstrualCalendar\Repositories\MenstrualDateRepositoryInterface;

/**
 * Insert menstrual date use case
 */
class InsertMenstrualDate
{
    /**
     * Constructor method
     *
     * @param MenstrualDateRepositoryInterface $respository
     */
    public function __construct(private MenstrualDateRepositoryInterface $respository)
    {
    }

    /**
     * Execute
     *
     * @param MenstruationDate $lastMenstruationDate
     * @return boolean
     */
    public function execute(MenstruationDate $lastMenstruationDate): MenstruationDate
    {
        $this->respository->save($lastMenstruationDate);
        
        return $lastMenstruationDate;
    }
}
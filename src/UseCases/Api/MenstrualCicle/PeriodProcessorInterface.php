<?php

namespace CicloMenstrual\UseCases\Api\MenstrualCicle;

use CicloMenstrual\UseCases\Api\MenstrualCicle\Data\PeriodInterface;

interface PeriodProcessorInterface
{
    /**
     * Period processor
     *
     * @param PeriodInterface $period
     * @return array
     */
    public function process(PeriodInterface $period): array;
}
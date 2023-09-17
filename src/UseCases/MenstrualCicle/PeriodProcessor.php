<?php

namespace CicloMenstrual\UseCases\MenstrualCicle;

use CicloMenstrual\UseCases\Api\MenstrualCicle\Data\PeriodInterface;
use DateInterval;
use DateTimeImmutable;

class PeriodProcessor
{
    public function  __construct(private MenstrualCicleProcessor $menstrualCicleProcessor)
    {
    }
    
    /**
     * Period processor
     *
     * @param PeriodInterface $period
     * @return array
     */
    public function process(PeriodInterface $period): array
    {
        $dateDiference = $period->getInitial()->diff($period->getFinal());
        $ciclesQuantity = $this->convertDaysInCicles($dateDiference->days);

        return $this->generateMenstrualCicles($ciclesQuantity, $period->getInitial());
    }

    /**
     * Convert days in cicles
     *
     * @param [type] $days
     * @return integer
     */
    private function convertDaysInCicles($days): int
    {
        return floor($days/28);
    }

    /**
     * Generate menstrual cicles
     *
     * @param integer $ciclesQuantity
     * @param DateTimeImmutable $initialPeriod
     * @return array
     */
    private function  generateMenstrualCicles(int $ciclesQuantity, DateTimeImmutable $initialPeriod): array
    {
        $menstrualCicles = [];
        for($i=0; $i < $ciclesQuantity; $i++){
            $menstrualCicle = $this->menstrualCicleProcessor->process(
                isset($menstrualCicleEndDate)
                ? $menstrualCicleEndDate->add(DateInterval::createFromDateString('1 day'))
                : $initialPeriod
            );
            $menstrualCicles[] = $menstrualCicle;
            $menstrualCicleEndDate = $menstrualCicle->getLutealPhase()->getEndDate();
        }

        return $menstrualCicles;
    }
}
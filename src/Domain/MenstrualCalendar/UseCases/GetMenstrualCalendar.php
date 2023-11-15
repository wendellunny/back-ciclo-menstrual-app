<?php

namespace CicloMenstrual\Domain\MenstrualCalendar\UseCases;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\FertilePeriod;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\LutealPhase;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Menstruation;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\MenstruationDate;
use DateInterval;

/**
 * Get menstrual calendar use case
 */
class GetMenstrualCalendar
{
    /**
     * Execute use case
     *
     * @param MenstruationDate $initialDate
     * @param integer $cyclesQuantity
     * @return array
     */
    public function execute(MenstruationDate $initialDate, $cyclesQuantity = 3): array
    {
        $initialDate->getInitial();

        $cycles = [];

        for($i=0; $i < $cyclesQuantity; $i++) {
            $cycles[] = $this->buildCycle($initialDate);
            $this->updateMenstruationInitialDate($initialDate, $cycles[$i]);
        }
        
        return $cycles;
    }

    /**
     * Build cycle
     *
     * @param MenstruationDate $initialDate
     * @return array
     */
    private function buildCycle(MenstruationDate $initialDate): array
    {
        $menstruation   = (new Menstruation)->calculate($initialDate)->getData();
        $fertilePeriod  = (new FertilePeriod)->calculate($menstruation)->getData();
        $lutealPhase    = (new LutealPhase)->calculate($fertilePeriod)->getData();

        return [
            'menstruation'      => $menstruation,
            'fertile_period'    => $fertilePeriod,
            'luteal_phase'      => $lutealPhase
        ];
    }

    /**
     * Update menstruation initial date
     *
     * @param MenstruationDate $initialDate
     * @param array $currentCycle
     * @return void
     */
    private function updateMenstruationInitialDate(MenstruationDate $initialDate, array $currentCycle): void
    {
        $initialDate->setInitial(
            $currentCycle['luteal_phase']->getEndDate()->add(
                DateInterval::createFromDateString('1 day')
            )
        );
    }
}

<?php

namespace CicloMenstrual\Domain\MenstrualCalendar\UseCases;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\Factories\FertilePeriodFactory;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Factories\LutealPhaseFactory;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\Factories\MenstruationFactory;
use CicloMenstrual\Domain\MenstrualCalendar\Entities\MenstruationDate;
use DateInterval;

/**
 * Get menstrual calendar use case
 */
class GetMenstrualCalendar
{

    public function __construct(
        private MenstruationFactory     $menstruationFactory,
        private FertilePeriodFactory    $fertilePeriodFactory,
        private LutealPhaseFactory      $lutealPhaseFactory
    ) {
    }

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
        $menstruation   = $this->menstruationFactory->create()->calculate($initialDate)->getData();
        $fertilePeriod  = $this->fertilePeriodFactory->create()->calculate($menstruation)->getData();
        $lutealPhase    = $this->lutealPhaseFactory->create()->calculate($fertilePeriod)->getData();

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

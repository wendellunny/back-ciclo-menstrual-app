<?php

namespace CicloMenstrual\UseCases\MenstrualCicle;

use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicleInterface;
use CicloMenstrual\Domain\Entities\Data\Factories\MenstrualCicleFactory;
use CicloMenstrual\Domain\Entities\MenstrualCicle\FertilePeriodCalculator;
use CicloMenstrual\Domain\Entities\MenstrualCicle\LutealPhaseCalculator;
use CicloMenstrual\Domain\Entities\MenstrualCicle\MenstruationCalculator;
use DateTimeImmutable;

class MenstrualCicleProcessor
{
    public function __construct(
        private MenstrualCicleFactory $menstrualCicleFactory,
        private MenstruationCalculator $menstruationCalculator,
        private FertilePeriodCalculator $fertilePeriodCalculator,
        private LutealPhaseCalculator $lutealPhaseCalculator
    ) {
    }
    /**
     * Menstrual cicle processor
     *
     * @return MenstrualCicleInterface
     */
    public function process(DateTimeImmutable $menstruationDate): MenstrualCicleInterface
    {
        $menstruation = $this->menstruationCalculator->calculate($menstruationDate);
        $fertilePeriod = $this->fertilePeriodCalculator->calculate($menstruation);
        $lutealPhase = $this->lutealPhaseCalculator->calculate($fertilePeriod);

        return $this->menstrualCicleFactory->create([
            $menstruation,
            $fertilePeriod,
            $lutealPhase
        ]);
    }
}
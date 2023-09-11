<?php

namespace CicloMenstrual\Domain\Api\Entities\Data;

use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\FertilePeriodInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\LutealPhaseInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\MenstruationInterface;

interface MenstrualCicleInterface
{
    /**
     * Set Menstruation
     *
     * @param MenstruationInterface $menstruation
     * @return self
     */
    public function setMenstruation(MenstruationInterface $menstruation): self;

    /**
     * Get menstruation
     *
     * @return MenstruationInterface
     */
    public function getMenstruation(): MenstruationInterface;

    /**
     * Set fertile period
     *
     * @param FertilePeriodInterface $fertilePeriod
     * @return self
     */
    public function setFertilePeriod(FertilePeriodInterface $fertilePeriod): self;

    /**
     * Get fertile period
     *
     * @return FertilePeriodInterface
     */
    public function getFertilePeriod(): FertilePeriodInterface;

    /**
     * Set luteal phase
     *
     * @param LutealPhaseInterface $lutealPhase
     * @return self
     */
    public function setLutealPhase(LutealPhaseInterface $lutealPhase): self;

    /**
     * Get luteal phase
     *
     * @return LutealPhaseInterface
     */
    public function getLutealPhase(): LutealPhaseInterface;
}
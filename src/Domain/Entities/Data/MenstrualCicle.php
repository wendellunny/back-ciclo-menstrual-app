<?php

namespace CicloMenstrual\Domain\Entities\Data;

use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\FertilePeriodInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\LutealPhaseInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\MenstruationInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicleInterface;
use JsonSerializable;

class MenstrualCicle implements MenstrualCicleInterface, JsonSerializable
{
    
    public function __construct(
        private MenstruationInterface $menstruation,
        private FertilePeriodInterface $fertilePeriod,
        private LutealPhaseInterface $lutealPhase
    ){
    }
    /**
     * Set Menstruation
     *
     * @param MenstruationInterface $menstruation
     * @return self
     */
    public function setMenstruation(MenstruationInterface $menstruation): self
    {
        $this->menstruation = $menstruation;
        return $this;
    }

    /**
     * Get menstruation
     *
     * @return MenstruationInterface
     */
    public function getMenstruation(): MenstruationInterface
    {
        return $this->menstruation;
    }

    /**
     * Set fertile period
     *
     * @param FertilePeriodInterface $fertilePeriod
     * @return self
     */
    public function setFertilePeriod(FertilePeriodInterface $fertilePeriod): self
    {
        $this->fertilePeriod = $fertilePeriod;
        return $this;
    }

    /**
     * Get fertile period
     *
     * @return FertilePeriodInterface
     */
    public function getFertilePeriod(): FertilePeriodInterface
    {
        return $this->fertilePeriod;
    }

    /**
     * Set luteal phase
     *
     * @param LutealPhaseInterface $lutealPhase
     * @return self
     */
    public function setLutealPhase(LutealPhaseInterface $lutealPhase): self
    {
        $this->lutealPhase = $lutealPhase;
        return $this;
    }

    /**
     * Get luteal phase
     *
     * @return LutealPhaseInterface
     */
    public function getLutealPhase(): LutealPhaseInterface
    {
        return $this->lutealPhase;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'menstrual_cicle' => [
                'menstruation' => $this->menstruation,
                'fertile_period' => $this->fertilePeriod,
                'luteal_phase' => $this->lutealPhase
            ]
        ];
    }
}
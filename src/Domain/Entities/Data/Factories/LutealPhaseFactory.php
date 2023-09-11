<?php

namespace CicloMenstrual\Domain\Entities\Data\Factories;

use CicloMenstrual\Domain\Api\FactoryInterface;
use CicloMenstrual\Domain\Entities\Data\LutealPhase;

class LutealPhaseFactory implements FactoryInterface
{
    /**
     * Create object
     *
     * @param array $args
     * @return mixed
     */
    public function create(array $args): mixed
    {
        return new LutealPhase(...$args);
    }
}
<?php

namespace CicloMenstrual\Domain\Entities\Data\MenstrualCicle\Factories;

use CicloMenstrual\Domain\Api\FactoryInterface;
use CicloMenstrual\Domain\Entities\Data\MenstrualCicle\Menstruation;

class MenstruationFactory implements FactoryInterface
{
    /**
     * Create object
     *
     * @param array $args
     * @return mixed
     */
    public function create(array $args): mixed
    {
        return new Menstruation(...$args);
    }
}

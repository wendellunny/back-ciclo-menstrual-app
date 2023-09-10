<?php

namespace CicloMenstrual\Domain\Entities\Data\Factories;

use CicloMenstrual\Domain\Api\FactoryInterface;
use CicloMenstrual\Domain\Entities\Data\FertilePeriod;

class FertilePeriodFactory implements FactoryInterface
{
    /**
     * Create object
     *
     * @param string $className
     * @param array $args
     * @return mixed
     */
    public function create(array $args): mixed
    {
        return new FertilePeriod(...$args);
    }
}
<?php

namespace CicloMenstrual\Domain\Api;

interface FactoryInterface
{
    /**
     * Create object
     *
     * @param array $args
     * @return mixed
     */
    public function create(array $args): mixed;
}
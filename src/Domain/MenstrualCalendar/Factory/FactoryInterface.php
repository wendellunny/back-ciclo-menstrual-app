<?php

namespace CicloMenstrual\Domain\MenstrualCalendar\Factory;

interface FactoryInterface
{
    /**
     * Instance object
     *
     * @param mixed ...$params
     * @return object
     */
    public function create(mixed ...$params): object;
}

<?php

namespace CicloMenstrual\Domain\MenstrualCalendar\Factory;

use stdClass;

class Factory implements FactoryInterface
{
    protected string $class = stdClass::class;

    /**
     * Instance object
     *
     * @param mixed ...$params
     * @return object
     */
    public function create(mixed ...$params): object
    {
        $class = $this->class;

        return new $class(...$params);
    }
}
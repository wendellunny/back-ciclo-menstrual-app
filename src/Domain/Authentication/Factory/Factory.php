<?php

namespace CicloMenstrual\Domain\Authentication\Factory;

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
<?php

namespace CicloMenstrual\Infrastructure;

class Singleton
{
    protected static Self $instance;

    /**
     * Get instance
     *
     * @return $this
     */
    public static function get(): self
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct()
    {
    }

}
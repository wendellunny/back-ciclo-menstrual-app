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
            $class = get_called_class();
            self::$instance = new $class();
        }

        return self::$instance;
    }

    protected function __construct()
    {
    }

}
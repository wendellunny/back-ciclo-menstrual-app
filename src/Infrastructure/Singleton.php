<?php

namespace CicloMenstrual\Infrastructure;

class Singleton
{
    public static $instances = [];

    /**
     * Undocumented function
     */
    protected function __construct()
    {
    }

    public static function getInstance(): static
    {
        $subClass = static::class;
        
        if(!isset(self::$instances[$subClass])){
            self::$instances
            [$subClass] = new $subClass();
        }

        return self::$instances[$subClass];
    }
}
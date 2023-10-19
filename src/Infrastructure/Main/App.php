<?php

namespace CicloMenstrual\Infrastructure\Main;

use CicloMenstrual\Infrastructure\Api\Main\AppInterface;
use Throwable;

class App implements AppInterface
{
    use AppTrait;

    public function start(): void
    {
        try{
            $this->configure(static::DI_DEFINITIONS);
        }catch(Throwable $e){
            $this->formatErrors($e);
        }
        
    }
}
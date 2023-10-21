<?php

namespace CicloMenstrual\Infrastructure\Api\Main;

interface AppInterface
{
    public const DI_DEFINITIONS =
        __DIR__     . DIRECTORY_SEPARATOR
        . '..'      . DIRECTORY_SEPARATOR
        . '..'      . DIRECTORY_SEPARATOR
        . '..'      . DIRECTORY_SEPARATOR
        . '..'      . DIRECTORY_SEPARATOR
        . 'config'  . DIRECTORY_SEPARATOR
        . 'di'      . DIRECTORY_SEPARATOR
        . '*.php';

    /**
     * Start
     *
     * @return void
     */
    public function start(): void;
}

<?php

namespace CicloMenstrual\Infrastructure\Providers;

interface ProviderInterface
{
    /**
     * Provider
     *
     * @return void
     */
    public function handle(): void;
}
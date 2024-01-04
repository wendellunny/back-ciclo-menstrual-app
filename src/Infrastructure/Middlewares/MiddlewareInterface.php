<?php

namespace CicloMenstrual\Infrastructure\Middlewares;

use Psr\Http\Message\RequestInterface;

interface MiddlewareInterface
{
    /**
     * Handle method
     *
     * @param RequestInterface $request
     * @return void
     */
    public function handle(): void;
}
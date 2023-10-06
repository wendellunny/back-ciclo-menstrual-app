<?php

namespace CicloMenstrual\Infrastructure\Api\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ControllerInterface
{
    public function execute(RequestInterface $request): ResponseInterface;
}
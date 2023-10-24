<?php

namespace CicloMenstrual\Infrastructure\Api\Controllers;

use Psr\Http\Message\ResponseInterface;

interface ControllerInterface
{
    public function execute(): ResponseInterface;
}
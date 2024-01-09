<?php

namespace CicloMenstrual\Infrastructure\Services\Request\Trait;

use Psr\Http\Message\RequestInterface;
use stdClass;

trait HasRequestFormatter
{
    private function getBody(RequestInterface $request): stdClass
    {
        return json_decode($request->getBody()->getContents());
    }
}
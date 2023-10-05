<?php

namespace CicloMenstrual\Infrastructure\Controllers;

use CicloMenstrual\Domain\Entities\Data\MenstrualCicle;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\ServerRequest as Request;

class MenstrualPeriodController
{
    
    public function execute(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {   
        $response->getBody()->write(json_encode(['key1' => 'teste']));
        return $response;
    }
}
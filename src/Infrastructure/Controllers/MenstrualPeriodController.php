<?php

namespace CicloMenstrual\Infrastructure\Controllers;

use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicleInterface;
use CicloMenstrual\Infrastructure\Api\Controllers\ControllerInterface;
use CicloMenstrual\UseCases\Api\MenstrualCicle\Data\PeriodInterface;
use CicloMenstrual\UseCases\Api\MenstrualCicle\PeriodProcessorInterface;
use CicloMenstrual\UseCases\MenstrualCicle\MenstrualCicleProcessor;
use DateTimeImmutable;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;


class MenstrualPeriodController implements ControllerInterface
{
    public function __construct(private Response $response, private PeriodProcessorInterface $periodProcessor, private PeriodInterface $period)
    {
        
    }
    
    public function execute(RequestInterface $request): ResponseInterface
    {
        $period = $this->periodProcessor->process(
            $this->period->setInitial(new DateTimeImmutable('2023-10-5')),
            $this->period->setFinal(new DateTimeImmutable('2024-01-31'))
        );
        
        $this->response
            ->getBody()
            ->write(json_encode($period));

        return $this->response;
    }
}
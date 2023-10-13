<?php

namespace CicloMenstrual\Infrastructure\Controllers;

use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicleInterface;
use CicloMenstrual\Infrastructure\Api\Controllers\ControllerInterface;
use CicloMenstrual\Infrastructure\Gateways\Jwt;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualCalendarInterface;
use CicloMenstrual\UseCases\Api\MenstrualCicle\Data\PeriodInterface;
use CicloMenstrual\UseCases\Api\MenstrualCicle\PeriodProcessorInterface;
use CicloMenstrual\UseCases\MenstrualCicle\MenstrualCicleProcessor;
use DateTimeImmutable;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;


class MenstrualCalendarController implements ControllerInterface
{
    public function __construct(private Response $response, private MenstrualCalendarInterface $menstrualcalendar)
    {
    
    }
    
    public function execute(RequestInterface $request): ResponseInterface
    {
        $calendar = $this->menstrualcalendar->execute();
        
        $this->response
            ->getBody()
            ->write(json_encode($calendar));

        return $this->response;
    }
}
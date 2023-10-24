<?php

namespace CicloMenstrual\Infrastructure\Controllers;

use CicloMenstrual\Infrastructure\Api\Controllers\ControllerInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualCalendarInterface;
use Psr\Http\Message\ResponseInterface;


class MenstrualCalendarController implements ControllerInterface
{
    public function __construct(
        private ResponseInterface $response,
        private MenstrualCalendarInterface $menstrualcalendar
    ) {
    }
    
    public function execute(): ResponseInterface
    {
        $calendar = $this->menstrualcalendar->execute();
        
        $this->response
            ->getBody()
            ->write(json_encode($calendar));

        return $this->response;
    }
}

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
    public function __construct(private Response $response, private MenstrualCalendarInterface $menstrualcalendar, private Jwt $jwt)
    {
    
    }
    
    public function execute(RequestInterface $request): ResponseInterface
    {
        $this->verifyToken();
        $calendar = $this->menstrualcalendar->execute();
        
        $this->response
            ->getBody()
            ->write(json_encode($calendar));

        return $this->response;
    }

    private function verifyToken()
    {
        if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
            header('HTTP/1.0 400 Bad Request');
            echo 'Token not found in request';
            exit;
        }

        $jwt = $matches[1];
        if (! $jwt) {
            // No token was able to be extracted from the authorization header
            header('HTTP/1.0 400 Bad Request');
            exit;
        }
        $token = $this->jwt->decode($jwt);
        $now = new DateTimeImmutable();
        $serverName = "127.0.0.1";

        if ($token->iss !== $serverName ||
            $token->nbf > $now->getTimestamp() ||
            $token->exp < $now->getTimestamp())
        {
            header('HTTP/1.1 401 Unauthorized');
            exit;
        }
    }
}
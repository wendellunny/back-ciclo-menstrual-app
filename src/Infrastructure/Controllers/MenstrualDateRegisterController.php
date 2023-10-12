<?php

namespace CicloMenstrual\Infrastructure\Controllers;

use CicloMenstrual\Infrastructure\Api\Controllers\ControllerInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualDateRegisterInterface;
use CicloMenstrual\UseCases\MenstrualCalendar\MenstrualDateRegister;
use DateTimeImmutable;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

class MenstrualDateRegisterController implements ControllerInterface
{
    public function __construct(
        private Response $response,
        private MenstrualDateRegisterInterface $menstrualDateRegister
    ) {
    }

    public function execute(RequestInterface $request): ResponseInterface
    {
        $requestData = json_decode($request->getBody()->getContents());
        $lastMenstrualDate = new DateTimeImmutable(
            $requestData->last_menstrual_date
        );
        $isSaved = $this->menstrualDateRegister->execute($lastMenstrualDate);
        
        $message = $isSaved
            ? [
                'message' => 'Data registrada com sucesso'
            ]
            : [
                'message' => 'Houve falha no registro'
            ];

        $this->response
            ->getBody()
            ->write(json_encode($message));

        return $this->response;
    }
}
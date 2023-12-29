<?php

namespace CicloMenstrual\Infrastructure\Controllers\MenstrualCalendar;

use CicloMenstrual\Domain\MenstrualCalendar\Entities\MenstruationDate;
use CicloMenstrual\Domain\MenstrualCalendar\Repositories\MenstrualDateRepositoryInterface;
use CicloMenstrual\Domain\MenstrualCalendar\UseCases\GetMenstrualCalendar;
use CicloMenstrual\Domain\MenstrualCalendar\UseCases\InsertMenstrualDate;
use DateTimeImmutable;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;


class MenstrualCalendarController
{
    public function __construct(
        private RequestInterface $request,
        private ResponseInterface $response,
        private InsertMenstrualDate $insertMenstrualDate,
        private GetMenstrualCalendar $getMenstrualCalendar,
        private MenstrualDateRepositoryInterface $menstrualDaterepository
    ) {
    }

    /**
     * Show menstrual calendar
     *
     * @return ResponseInterface
     */
    public function show(): ResponseInterface
    {
        $body                   = json_decode($this->request->getBody()->getContents());
        $lastMenstrualDate      = $this->menstrualDaterepository->loadLast();
        $menstrualCalendarData  = $this->getMenstrualCalendar->execute($lastMenstrualDate, (int)$body->amount);

        $this->response
            ->getBody()
            ->write(json_encode($menstrualCalendarData));

        return $this->response;

    }

    /**
     * Store last date
     *
     * @return ResponseInterface
     */
    public function storeDate(): ResponseInterface
    {
        $body = json_decode($this->request->getBody()->getContents());
        
        $lastMenstruationDate = new MenstruationDate(
            new DateTimeImmutable($body->last_menstrual_date)
        );

        $message = $this->insertMenstrualDate->execute($lastMenstruationDate)
            ? ['message' => 'Data registrada com sucessoo']
            : ['message' => 'Falha ao registrar data'];

        $this->response
            ->getBody()
            ->write(json_encode($message));

        return $this->response;

    }
}

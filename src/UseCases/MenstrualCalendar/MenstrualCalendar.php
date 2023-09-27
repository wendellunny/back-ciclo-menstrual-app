<?php

namespace CicloMenstrual\UseCases\MenstrualCalendar;

use CicloMenstrual\UseCases\Api\Authentication\Session\LoggedSessionInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualCalendarInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualDateRepositoryInterface;
use CicloMenstrual\UseCases\Api\MenstrualCicle\PeriodProcessorInterface;
use CicloMenstrual\UseCases\MenstrualCicle\Data\Period;
use DateInterval;
use DateTimeImmutable;

class MenstrualCalendar implements MenstrualCalendarInterface
{
    public function __construct(
        private PeriodProcessorInterface $periodProcessor,
        private LoggedSessionInterface $loggedSession,
        private MenstrualDateRepositoryInterface $menstrualDateRepository
    ) {
    }

    /**
     * execute
     *
     * @return array
     */
    public function execute(): array
    {
        $lastUserMenstrualDate = $this->menstrualDateRepository->loadLastMenstrualDateByUser(
            $this->loggedSession->getUser()
        );

        $startDate = new DateTimeImmutable($lastUserMenstrualDate->getDate());
        $dateInterval = DateInterval::createFromDateString('12 months');
        $endDate = $startDate->add($dateInterval);

        $period = new Period($startDate, $endDate);
        
        return $this->periodProcessor->process($period);
    }
}
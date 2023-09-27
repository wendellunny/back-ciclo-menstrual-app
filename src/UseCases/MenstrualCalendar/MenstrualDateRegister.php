<?php

namespace CicloMenstrual\UseCases\MenstrualCalendar;

use CicloMenstrual\UseCases\Api\Authentication\Session\LoggedSessionInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualDateRegisterInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualDateRepositoryInterface;
use CicloMenstrual\UseCases\MenstrualCalendar\Data\UserMenstrualDateFactory;
use DateTimeImmutable;

class MenstrualDateRegister implements MenstrualDateRegisterInterface
{

    public function __construct(
        private LoggedSessionInterface $loggedSession,
        private MenstrualDateRepositoryInterface $userMenstrualDateRepository,
        private UserMenstrualDateFactory $userMenstrualDateFactory
    ) {
    }

    /**
     * Execute method
     *
     * @param DateTimeImmutable $date
     * @return boolean
     */
    public function execute(DateTimeImmutable $lastMenstruationDate): bool
    {
        $userUuid = $this->loggedSession->getUser()->getUuid();

        $userMenstrualDate = $this->userMenstrualDateFactory->create([
            'uuid' => uniqid(),
            'date' => $lastMenstruationDate->format('Y-m-d'),
            'userUuid' => $userUuid
        ]);

        return $this->userMenstrualDateRepository->save($userMenstrualDate);
    }
}
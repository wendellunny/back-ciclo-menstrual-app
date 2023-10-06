<?php

namespace CicloMenstrual\Infrastructure\Repositories;

use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\Data\UserMenstrualDateInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualDateRepositoryInterface;
use CicloMenstrual\UseCases\MenstrualCalendar\Data\UserMenstrualDateFactory;

class MenstrualDateRepositoryMock implements MenstrualDateRepositoryInterface
{
    public function __construct(private UserMenstrualDateFactory $userMenstrualDateFactory)
    {
        
    }

    /**
     * Undocumented function
     *
     * @param UserMenstrualDateInterface $userMenstrualDate
     * @return boolean
     */
    public function save(UserMenstrualDateInterface $userMenstrualDate): bool
    {
        return true;
    }

    /**
     * Undocumented function
     *
     * @param UserInterface $user
     * @return UserMenstrualDateInterface
     */
    public function loadLastMenstrualDateByUser(UserInterface $user): UserMenstrualDateInterface
    {
        return $this->userMenstrualDateFactory->create([
            'uuid' => 'uuid-mockado',
            'date' => '2023-10-05',
            'userUuid' => 'uuid-user-mockad'
        ]);
    }
}
<?php

namespace CicloMenstrual\UseCases\Api\MenstrualCalendar;

use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\Data\UserMenstrualDateInterface;

interface MenstrualDateRepositoryInterface
{
    /**
     * Undocumented function
     *
     * @param UserMenstrualDateInterface $userMenstrualDate
     * @return boolean
     */
    public function save(UserMenstrualDateInterface $userMenstrualDate): bool;

    /**
     * Undocumented function
     *
     * @param UserInterface $user
     * @return UserMenstrualDateInterface
     */
    public function loadLastMenstrualDateByUser(UserInterface $user): UserMenstrualDateInterface;
}
<?php

namespace CicloMenstrual\UseCases\MenstrualCalendar\Data;

use CicloMenstrual\UseCases\Api\MenstrualCalendar\Data\UserMenstrualDateInterface;

class UserMenstrualDateFactory
{
    /**
     * Create
     *
     * @return UserMenstrualDateInterface
     */
    public function create(array $params = []): UserMenstrualDateInterface
    {
        return new UserMenstrualDate(...$params);
    }
}
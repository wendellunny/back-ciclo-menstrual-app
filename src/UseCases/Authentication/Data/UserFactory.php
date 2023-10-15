<?php

namespace CicloMenstrual\UseCases\Authentication\Data;

use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;
use CicloMenstrual\UseCases\Authentication\Data\User;

class UserFactory
{
    /**
     * Create method
     *
     * @param array $params
     * @return UserInterface
     */
    public function create($params = []): UserInterface
    {
        if(count($params) > 0) {
            return new User(...$params);
        }
        return new User();
    }
}
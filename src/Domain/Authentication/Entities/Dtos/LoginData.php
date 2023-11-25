<?php

namespace CicloMenstrual\Domain\Authentication\Entities\Dtos;

/**
 * Login data DTO
 */
class LoginData
{
    /**
     * Constructor Method
     *
     * @param string $email
     * @param string $password
     */
    public function __construct(private string $email, private string $password)
    {
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
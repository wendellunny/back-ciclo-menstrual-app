<?php

namespace CicloMenstrual\Domain\Authentication\Entities\Dtos;

/**
 * Register data DTO
 */
class RegisterData
{
    /**
     * Constructor method
     *
     * @param string $name
     * @param string $birthDate
     * @param string $email
     * @param string $password
     */
    public function __construct(
        private string $name,
        private string $birthDate,
        private string $email,
        private string $password
    ) {
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get birth date
     *
     * @return string
     */
    public function getBirthDate(): string
    {
        return $this->birthDate;
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
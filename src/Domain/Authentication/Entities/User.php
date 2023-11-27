<?php

namespace CicloMenstrual\Domain\Authentication\Entities;

class User
{
    private string $uuid;
    private string $name;
    private string $birthDate;
    private string $email;
    private string $passwordHash;

    /**
     * Set uuid
     *
     * @param string $uuid
     * @return self
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
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
     * Set birth date
     *
     * @param string $birthDate
     * @return self
     */
    public function setBirthDate(string $birthDate): self
    {
        $this->birthDate = $birthDate;
        return $this;
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
     * Set email
     *
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
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
     * Set password
     *
     * @param string $passwordHash
     * @return self
     */
    public function setPassword(string $passwordHash): self
    {
        $this->passwordHash = $passwordHash;
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->passwordHash;
    }
}
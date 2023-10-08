<?php

namespace CicloMenstrual\UseCases\Api\Authentication\Data;

interface   UserInterface
{
    /**
     * Undocumented function
     *
     * @param string $id
     * @return self
     */
    public function setUuid(string $uuid): self;

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getUuid(): string;
    
    /**
     * Undocumented function
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self;

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Undocumented function
     *
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self;
    
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getEmail(): string;

    /**
     * Undocumented function
     *
     * @param string $phone
     * @return self
     */
    public function setPhone(string $phone): self;

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getPhone(): string;

    /**
     * Undocumented function
     *
     * @param string $password
     * @return self
     */
    public function setPassword(string $password): self;

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getPassword(): string;
}
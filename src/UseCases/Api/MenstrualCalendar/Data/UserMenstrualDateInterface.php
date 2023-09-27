<?php

namespace CicloMenstrual\UseCases\Api\MenstrualCalendar\Data;

interface UserMenstrualDateInterface
{
    /**
     * Set uuid
     *
     * @param string $uuid
     * @return self
     */
    public function setUuid(string $uuid): self;

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid(): string;

    /**
     * Set date
     *
     * @param string $date
     * @return self
     */
    public function setDate(string $date): self;

    /**
     * Get date
     *
     * @return string
     */
    public function getDate(): string;

    /**
     * Set user uuid
     *
     * @param string $userUuid
     * @return self
     */
    public function setUserUuid(string $userUuid): self;

    /**
     * Get user uuid
     *
     * @return string
     */
    public function getUserUuid(): string;
}
<?php

namespace CicloMenstrual\UseCases\MenstrualCalendar\Data;

use CicloMenstrual\UseCases\Api\MenstrualCalendar\Data\UserMenstrualDateInterface;

class UserMenstrualDate implements UserMenstrualDateInterface
{

    public function __construct(
        private ?string $uuid = null,
        private ?string $date = null,
        private ?string $userUuid = null
    ){
    }

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
     * Set date
     *
     * @param string $date
     * @return self
     */
    public function setDate(string $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * Set user uuid
     *
     * @param string $userUuid
     * @return self
     */
    public function setUserUuid(string $userUuid): self
    {
        $this->userUuid = $userUuid;
        return $this;
    }

    /**
     * Get user uuid
     *
     * @return string
     */
    public function getUserUuid(): string
    {
        return $this->userUuid;
    }
}
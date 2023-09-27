<?php

namespace CicloMenstrual\UseCases\Authetication\Data;

use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;

class User implements UserInterface
{
    private ?int $id;

    private string $uuid;

    private ?string $name;

    private ?string $email;

    private ?string $phone;

    private ?string $password;


    public function __construct(
        ?int $id = null,
        ?string $name = null,
        ?string $email = null,
        ?string $phone = null,
        ?string $password = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
    }

    /**
     * Undocumented function
     *
     * @param string $id
     * @return self
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

     /**
     * Undocumented function
     *
     * @param integer $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }
    
    /**
     * Undocumented function
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
     * Undocumented function
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Undocumented function
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
     * Undocumented function
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Undocumented function
     *
     * @param string $phone
     * @return self
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * Undocumented function
     *
     * @param string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}


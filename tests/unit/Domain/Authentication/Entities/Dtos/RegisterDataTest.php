<?php

namespace Tests\Domain\Authentication\Entities\Dtos;

use CicloMenstrual\Domain\Authentication\Entities\Dtos\RegisterData;
use PHPUnit\Framework\TestCase;

/**
 * Register data test
 */
class RegisterDataTest extends TestCase
{

    private RegisterData    $instance;
    private string          $name       = 'John Doe';
    private string          $birthDate  = '2000-08-07';
    private string          $email      = 'wendel@teste.com';
    private string          $password   = 'teste123';

    /**
     * Set up metho
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->instance = new RegisterData(
            $this->name,
            $this->birthDate,
            $this->email,
            $this->password
        );
    }

    /**
     * Test getters
     *
     * @return void
     */
    public function testGetters(): void
    {
        $this->assertEquals(
            $this->name,
            $this->instance->getName()
        );

        $this->assertEquals(
            $this->birthDate,
            $this->instance->getBirthDate()
        );

        $this->assertEquals(
            $this->email,
            $this->instance->getEmail()
        );

        $this->assertEquals(
            $this->password,
            $this->instance->getPassword()
        );
    }
}

<?php

namespace Tests\Domain\Authentication\Entities\Dtos;

use CicloMenstrual\Domain\Authentication\Entities\Dtos\LoginData;
use PHPUnit\Framework\TestCase;

/**
 * Login data test
 */
class LoginDataTest extends TestCase
{

    private LoginData   $instance;
    private string      $email      = 'wendel@teste.com';
    private string      $password   = 'teste123';

    /**
     * Set up metho
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->instance = new LoginData($this->email, $this->password);
    }

    /**
     * Test getters
     *
     * @return void
     */
    public function testGetters(): void
    {
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
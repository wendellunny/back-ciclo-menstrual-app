<?php

namespace Tests\Domain\Authentication\Entities;

use CicloMenstrual\Domain\Authentication\Entities\User;
use PHPUnit\Framework\TestCase;

/**
 * User test
 */
class UserTest extends TestCase
{

    private User $instance;

    /**
     * Set up method
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->setInstance();
    }

    /**
     * Set instance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new User();
    }

    /**
     * @test
     * @dataProvider dataProvider
     *
     * @param string    $getter
     * @param string    $setter
     * @param mixed     $value
     * @return void
     */
    public function testGettersAndSetters(string $getter, string $setter, mixed $value): void
    {
        $this->assertEquals(
            $this->instance,
            $this->instance->$setter($value)
        );

        $this->assertEquals(
            $value,
            $this->instance->$getter()
        );
    }

    /**
     * Data provider
     *
     * @return array
     */
    public static function dataProvider(): array
    {
        return [
            'whenUuidField' => [
                'getter'    => 'getUuid',
                'setter'    => 'setUuid',
                'value'     => 'uuiddeteste'
            ],
            'whenNameField' => [
                'getter'    => 'getName',
                'setter'    => 'setName',
                'value'     => 'John Doe'
            ],
            'whenBirthDateField' => [
                'getter'    => 'getBirthDate',
                'setter'    => 'setBirthDate',
                'value'     => '2000-08-07'
            ],
            'whenEmailField' => [
                'getter'    => 'getEmail',
                'setter'    => 'setEmail',
                'value'     => 'wendel@teste.com'
            ],
            'whenPasswordField' => [
                'getter'    => 'getPassword',
                'setter'    => 'setPassword',
                'value'     => '$2a$12$HAQt2pkcTK21UcWyiM6EsOWh1mRl5zlqlzXbejZz4AJlfMqLwOCd.'
            ],

        ];
    }
}
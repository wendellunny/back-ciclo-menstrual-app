<?php

namespace CicloMenstrual\Domain\Authentication\UseCases;

use CicloMenstrual\Domain\Authentication\Config\AuthConfigInterface;
use CicloMenstrual\Domain\Authentication\Entities\Dtos\RegisterData;
use CicloMenstrual\Domain\Authentication\Entities\Factories\UserFactory;
use CicloMenstrual\Domain\Authentication\Entities\User;
use CicloMenstrual\Domain\Authentication\Repositories\UserRepositoryInterface;
use CicloMenstrual\Domain\Authentication\UseCases\Register;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Throwable;

/**
 * Register test
 */
class RegisterTest extends TestCase
{

    protected const                             ENCRYPT_ALGORITHM   = 'AES-256-CBC';
    protected const                             ENCRYPT_KEY         = 'key_teste';
    private Register $instance;
    private MockObject|UserRepositoryInterface $userRepositoryMock;
    private MockObject|AuthConfigInterface $authConfigMock;
    private MockObject|RegisterData $registerDataMock;
    private MockObject|UserFactory $userFactoryMock;
    private MockObject|User $userMock;

    /**
     * Set up method
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->setMocks();
        $this->setInstance();
    }

    /**
     * Set mocks
     *
     * @return void
     */
    private function setMocks(): void
    {
        $this->userRepositoryMock = $this->createMock(UserRepositoryInterface::class);
        $this->authConfigMock = $this->createMock(AuthConfigInterface::class);
        $this->registerDataMock = $this->createMock(RegisterData::class);
        $this->userFactoryMock = $this->createMock(UserFactory::class);
        $this->userMock = $this->createMock(User::class);
    }

    /**
     * Set instance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new Register($this->userRepositoryMock, $this->authConfigMock, $this->userFactoryMock);
    }

    /**
     * @test
     * @dataProvider dataProvider
     *
     * @param string $name
     * @param string $email
     * @param string $birthDate
     * @param string $password
     * @return void
     */
    public function testExecute(string $name, string $email, string $birthDate, string $password): void
    {
        $this->userFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->userMock);

        $this->registerDataMock
            ->expects($this->once())
            ->method('getName')
            ->willReturn($name);

        $this->userMock
            ->expects($this->once())
            ->method('setName')
            ->with($name)
            ->willReturnSelf();

        $this->registerDataMock
            ->expects($this->once())
            ->method('getEmail')
            ->willReturn($email);

        $this->userMock
            ->expects($this->once())
            ->method('setEmail')
            ->with($email)
            ->willReturnSelf();

        $this->registerDataMock
            ->expects($this->once())
            ->method('getBirthDate')
            ->willReturn($birthDate);

        $this->userMock
            ->expects($this->once())
            ->method('setBirthDate')
            ->with($birthDate)
            ->willReturnSelf();

        $this->registerDataMock
            ->expects($this->once())
            ->method('getPassword')
            ->willReturn($password);

        $this->authConfigMock
            ->expects($this->once())
            ->method('getEncryptAlgorithm')
            ->willReturn(static::ENCRYPT_ALGORITHM);
        
        $this->authConfigMock
            ->expects($this->once())
            ->method('getEncryptKey')
            ->willReturn(static::ENCRYPT_KEY);
    
        $this->userMock
            ->expects($this->once())
            ->method('setPassword')
            ->willReturnSelf();

        $this->userMock
            ->expects($this->once())
            ->method('setUuid')
            ->willReturnSelf();

        $this->userRepositoryMock
            ->expects($this->once())
            ->method('save')
            ->with($this->userMock)
            ->willReturn(true);

        $this->instance->execute($this->registerDataMock);
        
    }

    public static function dataProvider(): array
    {
        return [
            'whenSuccess' => [
                'name' => 'John Doe',
                'email' => 'wendel@teste.com',
                'birthDate' => '2000-08-07',
                'password' => 'minhasenha'
            ]
        ];
    }
}
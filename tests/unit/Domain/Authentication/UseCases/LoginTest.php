<?php

namespace Tests\Domain\Authentication\UseCases;

use CicloMenstrual\Domain\Authentication\Config\AuthConfigInterface;
use CicloMenstrual\Domain\Authentication\Entities\Dtos\LoginData;
use CicloMenstrual\Domain\Authentication\Entities\User;
use CicloMenstrual\Domain\Authentication\Repositories\UserRepositoryInterface;
use CicloMenstrual\Domain\Authentication\UseCases\Login;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestStatus\Warning;

/**
 * Login Test
 */
class LoginTest extends TestCase
{

    protected const                             ENCRYPT_ALGORITHM   = 'AES-256-CBC';
    protected const                             ENCRYPT_KEY         = 'key_teste';
    private Login                               $instance;
    private MockObject|UserRepositoryInterface  $userRepositoryMock;
    private MockObject|LoginData                $loginDataMock;
    private MockObject|User                     $userMock;
    private MockObject|AuthConfigInterface      $authConfigMock;

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
        $this->userRepositoryMock   = $this->createMock(UserRepositoryInterface::class);
        $this->loginDataMock        = $this->createMock(LoginData::class);
        $this->userMock             = $this->createMock(User::class);
        $this->authConfigMock       = $this->createMock(AuthConfigInterface::class);
    }

    /**
     * Set instance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new Login(
            $this->userRepositoryMock,
            $this->authConfigMock
        );
    }

    /**
     * @test
     * @dataProvider dataProvider
     *
     * @param string    $email
     * @param boolean   $hasUser
     * @param string    $passwordHash
     * @param string    $userUuid
     * @param string    $password
     * @param boolean   $areCorrectCredentials
     * @return void
     */
    public function testAuthenticate(
        string  $email,
        bool    $hasUser,
        ?string $passwordHash,
        ?string $userUuid,
        string  $password,
        bool    $areCorrectCredentials
    ): void {

        $this->loginDataMock
            ->expects($this->once())
            ->method('getEmail')
            ->willReturn($email);

        $this->userRepositoryMock
            ->expects($this->once())
            ->method('findByEmail')
            ->with($email)
            ->willReturn($this->userMock);

        if($hasUser) {
            $this->userMock
                ->expects($this->once())
                ->method('getPassword')
                ->willReturn($passwordHash);

            $this->userMock
                ->expects($this->once())
                ->method('getUuid')
                ->willReturn($userUuid);
        }

        $this->loginDataMock
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

        $this->assertEquals(
            $areCorrectCredentials ? $this->userMock : false,
            $this->instance->authenticate($this->loginDataMock)
        );
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public static function dataProvider(): array
    {
        return [
            'whenCorrectUserCredentials' => [
                'email'                 => 'lunny@teste.com',
                'hasUser'               => true,
                'passwordHash'          => static::makePasswordHash($password = 'wendellunny123', $userUuid = 'useruuid'),
                'userUuid'              => $userUuid,
                'password'              => $password,
                'areCorrectCredentials' => true
            ],
            'whenIncorrectPassword' => [
                'email'                 => 'wendel@teste.com',
                'hasUser'               => true,
                'passwordHash'          => static::makePasswordHash('wendel123', $userUuid = 'useruuid'),
                'userUuid'              => $userUuid,
                'password'              => 'teste123',
                'areCorrectCredentials' => false
            ],
            'whenEmailNotFound' => [
                'email'                 => 'wendel@teste.com',
                'hasUser'               => false,
                'passwordHash'          => null,
                'userUuid'              => null,
                'password'              => 'teste123',
                'areCorrectCredentials' => false
            ]
        ];
    }

    /**
     * Make password hash
     *
     * @param string $password
     * @param string $uuid
     * @return string
     */
    private static function makePasswordHash(string $password, string $uuid): string
    {
        $passwordSalt = "{$uuid}_{$password}";
        $hash = password_hash($passwordSalt, PASSWORD_BCRYPT);
        
        return openssl_encrypt($hash, static::ENCRYPT_ALGORITHM, static::ENCRYPT_KEY);
    }
}
<?php

namespace Tests\Domain\Authentication\UseCases;

use CicloMenstrual\Domain\Authentication\Entities\Dtos\LoginData;
use CicloMenstrual\Domain\Authentication\Entities\User;
use CicloMenstrual\Domain\Authentication\Repositories\UserRepositoryInterface;
use CicloMenstrual\Domain\Authentication\UseCases\Login;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    private Login $instance;
    private MockObject|UserRepositoryInterface $userRepositoryMock;
    private MockObject|LoginData $loginDataMock;
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
        $this->loginDataMock = $this->createMock(LoginData::class);
        $this->userMock = $this->createMock(User::class);
    }

    /**
     * Set instance
     *
     * @return void
     */
    private function setInstance(): void
    {
        $this->instance = new Login($this->userRepositoryMock);
    }

    /**
     * @test
     * @dataProvider dataProvider
     *
     * @param string $email
     * @param boolean $hasUser
     * @param string $passwordHash
     * @param string $userUuid
     * @param string $password
     * @param boolean $areCorrectCredentials
     * @return void
     */
    public function testAuthenticate(
        string $email,
        bool $hasUser,
        string $passwordHash,
        string $userUuid,
        string $password,
        bool $areCorrectCredentials
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
                ->expects($this->exactly(2))
                ->method('getPassword')
                ->willReturn($passwordHash);

            $this->userMock
                ->expects($this->once())
                ->method('getUuid')
                ->willReturn($userUuid);
        } else {
            $this->loginDataMock
                ->expects($this->once())
                ->method('getPassword')
                ->willReturn($password);
        }

        $this->assertEquals(
            $areCorrectCredentials,
            $this->instance->authenticate($this->loginDataMock)
        );
    }

    public static function dataProvider(): array
    {
        return [
            'whenCorrectUserCredentials' => [
                'email' => 'wendel@teste.com',
                'hasUser' => true,
                'passwordHash' => static::makePasswordHash($password = 'wendel123', $userUuid = 'useruuid'),
                'userUuid' => $userUuid,
                'password' => $password,
                'areCorrectCredentials' => true
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
        return openssl_encrypt($passwordSalt, 'AES-256-CBC', $_ENV['APP_ENCRYPT_KEY']);
    }
}
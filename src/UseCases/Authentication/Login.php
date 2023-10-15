<?php

namespace CicloMenstrual\UseCases\Authentication;

use CicloMenstrual\Infrastructure\Gateways\Jwt;
use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;
use CicloMenstrual\UseCases\Api\Authentication\LoginInterface;
use CicloMenstrual\UseCases\Api\Authentication\UserRepositoryInterface;
use CicloMenstrual\UseCases\Authentication\Exception\LoginException;
use DateTime;
use Psr\Http\Message\RequestInterface;

class Login implements LoginInterface
{
    /**
     * Constructor method
     *
     * @param UserRepositoryInterface $userRepository
     * @param Jwt $jwt
     * @param RequestInterface $request
     */
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private Jwt $jwt,
        private RequestInterface $request
    ) {
    }

    /**
     * Authenticate
     *
     * @param UserInterface $userRequestCredentials
     * @return void
     */
    public function authenticate(UserInterface $userRequestCredentials): string|false
    {
        $userSaved = $this->userRepository->loadByEmail(
            $userRequestCredentials->getEmail()
        );
        $password = $userSaved ? $userSaved->getPassword() : '';
        $uuid = $userSaved ? $userSaved->getUuid() : '';
        
        $decrypt = openssl_decrypt($password, 'AES-256-CBC', $_ENV['APP_ENCRYPT_KEY']);
        
        $passwordVerification = password_verify(
            "{$uuid}_{$userRequestCredentials->getPassword()}",
            $decrypt
        );
        

        if(!$userSaved || !$passwordVerification)
        {
            throw new LoginException();
        }

        return $this->generateJwtKey($userSaved);

    }

    /**
     * Generate jwt key
     *
     * @param UserInterface $userSaved
     * @return string
     */
    private function generateJwtKey (UserInterface $userSaved): string
    {
        $iss = $this->request->getHeader('host')[0];
        $iat  = time();
        $exp = $iat + 3600;
        $nbf = time();
        $sub = [
            'id' => $userSaved->getUuid(),
            'name' => $userSaved->getName()
        ];

        $jti = uniqid();
        
        $jwtData = compact('iss', 'sub' ,'iat', 'exp', 'nbf', 'jti');

        return $this->jwt->encode($jwtData);
    }
}
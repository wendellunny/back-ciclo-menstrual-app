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
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private Jwt $jwt,
        private RequestInterface $request
    ) {
    }
    /**
     * Authenticate
     *
     * @param UserInterface $user
     * @return void
     */
    public function authenticate(UserInterface $user): string|false
    {
        $userSaved = $this->userRepository->loadByEmail($user->getEmail());
        $password = $userSaved ? $userSaved->getPassword() : '';
        $uuid = $userSaved ? $userSaved->getUuid() : '';
        
        $decrypt = openssl_decrypt($password, 'AES-256-CBC', 'minha chave');
        $passwordVerification = password_verify("{$uuid}_{$user->getPassword()}", $decrypt);
        

        if(!$userSaved || !$passwordVerification)
        {
            throw new LoginException();
        }

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
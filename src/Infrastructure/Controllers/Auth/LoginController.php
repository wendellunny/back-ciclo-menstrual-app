<?php

namespace CicloMenstrual\Infrastructure\Controllers\Auth;

use CicloMenstrual\Infrastructure\Api\Controllers\ControllerInterface;
use CicloMenstrual\UseCases\Api\Authentication\LoginInterface;
use CicloMenstrual\UseCases\Authentication\Data\User;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

class LoginController implements ControllerInterface
{
    public function __construct(private LoginInterface $login, private Response $response)
    {
        
    }
    public function execute(RequestInterface $request): ResponseInterface
    {
        $body = json_decode($request->getBody()->getContents(), true);
        $user = new User();
        $user->setEmail($body['email']);
        $user->setPassword($body['password']);

        $jwtToken = $this->login->authenticate($user);

        $this->response
            ->getBody()
            ->write(json_encode(['token' => $jwtToken]));

        return $this->response;
    }
}
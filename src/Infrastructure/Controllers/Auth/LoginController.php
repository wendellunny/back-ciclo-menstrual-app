<?php

namespace CicloMenstrual\Infrastructure\Controllers\Auth;

use CicloMenstrual\Infrastructure\Api\Controllers\ControllerInterface;
use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;
use CicloMenstrual\UseCases\Api\Authentication\LoginInterface;
use CicloMenstrual\UseCases\Authentication\Data\UserFactory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

class LoginController implements ControllerInterface
{
    public function __construct(
        private LoginInterface $login,
        private Response $response,
        private UserFactory $userFactory
    ) {
        
    }
    public function execute(RequestInterface $request): ResponseInterface
    {
        $user = $this->buildUserData($request);
        $jwtToken = $this->login->authenticate($user);
        $this->buildResponseData($jwtToken);

        return $this->response;
    }

    private function buildUserData($request): UserInterface
    {
        $body = json_decode($request->getBody()->getContents(), true);
        $user = $this->userFactory->create();
        return $user->setEmail($body['email'])->setPassword($body['password']);
    }

    private function buildResponseData(string $jwtToken): void
    {
        $this->response
            ->getBody()
            ->write(json_encode(['token' => $jwtToken]));
    }
}
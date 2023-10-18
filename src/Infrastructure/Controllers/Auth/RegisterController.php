<?php

namespace CicloMenstrual\Infrastructure\Controllers\Auth;

use CicloMenstrual\Infrastructure\Api\Controllers\ControllerInterface;
use CicloMenstrual\UseCases\Authentication\Data\UserFactory;
use CicloMenstrual\UseCases\Authentication\Registration;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

class RegisterController implements ControllerInterface
{
    public function __construct(
        private UserFactory $userFactory,
        private Registration $registration,
        private Response $response
    ) {
        
    }
    public function execute(RequestInterface $request): ResponseInterface
    {
        $bodyData = json_decode($request->getBody()->getContents(), true);
        $user = $this->userFactory->create([
            'id' => null,
            'name' => $bodyData['name'],
            'email' => $bodyData['email'],
            'phone' => $bodyData['password'],
            'password' => $bodyData['password']
        ]);

        $message  = $this->registration->register($user)
            ? 'Usuário registrado com sucesso'
            : 'Falha ao registar usuário';
            
        $this->response->getBody()->write(json_encode(compact('message')));

        return $this->response;
    }
}
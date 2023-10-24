<?php

namespace CicloMenstrual\Infrastructure\Controllers\Auth;

use CicloMenstrual\Infrastructure\Api\Controllers\ControllerInterface;
use CicloMenstrual\UseCases\Authentication\Data\UserFactory;
use CicloMenstrual\UseCases\Authentication\Registration;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RegisterController implements ControllerInterface
{
    public function __construct(
        private RequestInterface $request,
        private ResponseInterface $response,
        private UserFactory $userFactory,
        private Registration $registration,
    ) {
        
    }
    public function execute(): ResponseInterface
    {
        $bodyData = json_decode($this->request->getBody()->getContents(), true);
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
<?php

namespace CicloMenstrual\Infrastructure\Controllers;

use CicloMenstrual\Infrastructure\Api\Controllers\ControllerInterface;
use CicloMenstrual\Infrastructure\Gateways\Jwt;
use CicloMenstrual\UseCases\Authentication\Data\User;
use CicloMenstrual\UseCases\Authentication\Login;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

class TesteController implements ControllerInterface
{
    public function __construct(private Jwt $jwt, private Login $login, private Response $response)
    {
    
    }

    public function execute(RequestInterface $request): ResponseInterface
    {
        dd($request->getBody()->getContents());
        $token = $this->login->authenticate((new User())->setName('lunny')->setUuid(uniqid()));
        $this->response->getBody()->write(json_encode(['token' => $token]));
        return $this->response;
    }
}
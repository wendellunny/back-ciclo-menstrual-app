<?php

namespace CicloMenstrual\Infrastructure\Controllers\Authentication;

use CicloMenstrual\Domain\Authentication\Entities\Dtos\LoginData;
use CicloMenstrual\Domain\Authentication\Entities\Dtos\RegisterData;
use CicloMenstrual\Domain\Authentication\UseCases\Login;
use CicloMenstrual\Domain\Authentication\UseCases\Register;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Login controller
 * TODO: Criar rota para este controller
 */
class LoginController
{
    /**
     * Constructor method
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param Login             $login
     * @param Register          $register
     */
    public function __construct (
        private RequestInterface    $request,
        private ResponseInterface   $response,
        private Login               $login,
        private Register            $register
    ) {
        
    }

    /**
     * Login
     *
     * @return ResponseInterface
     */
    public function login(): ResponseInterface
    {
        /**
         * TODO: Implementar JWT
         */
        $body       = json_decode($this->request->getBody()->getContents());
        $loginData  = new LoginData($body->email, $body->password);

        $message    = $this->login->authenticate($loginData)
            ? ['message' => 'Logado com sucesso']
            : ['message' => 'Usuário ou senha incorretos'];

        $this->response
            ->getBody()
            ->write(json_encode($message));
            
        return $this->response;
    }

    /**
     * Register
     *
     * @return ResponseInterface
     */
    public function register(): ResponseInterface
    {
        /**
         * TODO: Implementar validações
         */
        $body = json_decode($this->request->getBody()->getContents());

        $registerData = new RegisterData(
            $body->name,
            $body->birth_date,
            $body->email,
            $body->password
        );

        $this->register->execute($registerData);

        $message = ['message' => 'Usuário registrado com sucesso'];
        $this->response
            ->getBody()
            ->write(json_encode($message));

        return $this->response;
    }

    /**
     * Logout
     *
     * @return ResponseInterface
     */
    public function logout(): ResponseInterface
    {
        /**
         * TODO: Implementar lógica de logout
         */
        return $this->response;
    }
}
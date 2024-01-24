<?php

namespace CicloMenstrual\Infrastructure\Controllers\Authentication;

use CicloMenstrual\Domain\Authentication\Entities\Dtos\LoginData;
use CicloMenstrual\Domain\Authentication\Entities\Dtos\RegisterData;
use CicloMenstrual\Domain\Authentication\Entities\User;
use CicloMenstrual\Domain\Authentication\UseCases\Login;
use CicloMenstrual\Domain\Authentication\UseCases\Register;
use CicloMenstrual\Infrastructure\Gateways\Jwt;
use CicloMenstrual\Infrastructure\Services\Jwt\JwtEncoderInterface;
use CicloMenstrual\Infrastructure\Services\Request\Trait\HasRequestFormatter;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Login controller
 */
class LoginController
{
    use HasRequestFormatter;

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
        private Register            $register,
        private JwtEncoderInterface $jwt
    ) {
        
    }

    /**
     * Login
     *
     * @return ResponseInterface
     */
    public function login(): ResponseInterface
    {
        $body       = $this->getBody($this->request);
        $loginData  = new LoginData($body->email, $body->password);
        dd($body);
        $user = $this->login->authenticate($loginData);

        $message = $user
            ? ['token' => $this->generateJwtToken($user)]
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

     /**
     * Generate jwt key
     *
     * @param User $userSaved
     * @return string
     */
    private function generateJwtToken (User $user): string
    {
        $iss = $this->request->getHeader('host')[0];
        $iat  = time();
        $exp = $iat + 3600;
        $nbf = time();
        $sub = [
            'id' => $user->getUuid(),
            'name' => $user->getName()
        ];

        $jti = uniqid();
        
        $jwtData = compact('iss', 'sub' ,'iat', 'exp', 'nbf', 'jti');

        return $this->jwt->encode($jwtData);
    }
}
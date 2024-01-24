<?php

use CicloMenstrual\Domain\Authentication\Config\AuthConfig;
use CicloMenstrual\Domain\Authentication\Config\AuthConfigInterface;
use CicloMenstrual\Domain\Authentication\Repositories\UserRepositoryInterface;
use CicloMenstrual\Infrastructure\Repositories\UserRepository;
use CicloMenstrual\Infrastructure\Services\Jwt\Encoder as JwtEncoder;
use CicloMenstrual\Infrastructure\Services\Jwt\JwtEncoderInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;

use function DI\autowire;

return [
    RequestInterface::class => ServerRequestFactory::fromGlobals(
        $_SERVER,
        $_GET,
        $_POST,
        $_COOKIE,
        $_FILES
    ),
    ResponseInterface::class => autowire(Response::class),
    JwtEncoderInterface::class => autowire(JwtEncoder::class),
    UserRepositoryInterface::class => autowire(UserRepository::class),
    AuthConfigInterface::class => autowire(AuthConfig::class)
];

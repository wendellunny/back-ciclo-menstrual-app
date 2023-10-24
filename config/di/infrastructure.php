<?php

use CicloMenstrual\Infrastructure\Gateways\RouterGateway;
use CicloMenstrual\Infrastructure\Repositories\MenstrualDateRepositoryMock;
use CicloMenstrual\Infrastructure\Repositories\UserRepositoryMock;
use CicloMenstrual\Infrastructure\Session\LoggedSessionMock;
use CicloMenstrual\UseCases\Api\Authentication\Session\LoggedSessionInterface;
use CicloMenstrual\UseCases\Api\Authentication\UserRepositoryInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualDateRepositoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;

use function DI\autowire;

return [
    LoggedSessionInterface::class => autowire(LoggedSessionMock::class),
    MenstrualDateRepositoryInterface::class => autowire(MenstrualDateRepositoryMock::class),
    RequestInterface::class => ServerRequestFactory::fromGlobals(
        $_SERVER,
        $_GET,
        $_POST,
        $_COOKIE,
        $_FILES
    ),
    ResponseInterface::class => autowire(Response::class),
    UserRepositoryInterface::class => autowire(UserRepositoryMock::class),

];

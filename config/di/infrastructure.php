<?php

use CicloMenstrual\Infrastructure\Repositories\MenstrualDateRepositoryMock;
use CicloMenstrual\Infrastructure\Repositories\UserRepositoryMock;
use CicloMenstrual\Infrastructure\Session\LoggedSessionMock;
use CicloMenstrual\UseCases\Api\Authentication\Session\LoggedSessionInterface;
use CicloMenstrual\UseCases\Api\Authentication\UserRepositoryInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualDateRepositoryInterface;
use Psr\Http\Message\RequestInterface;
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
    UserRepositoryInterface::class => autowire(UserRepositoryMock::class)
];

<?php

use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;
use CicloMenstrual\UseCases\Api\Authentication\LoginInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\Data\UserMenstrualDateInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualCalendarInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualDateRegisterInterface;
use CicloMenstrual\UseCases\Api\MenstrualCicle\Data\PeriodInterface;
use CicloMenstrual\UseCases\Api\MenstrualCicle\PeriodProcessorInterface;
use CicloMenstrual\UseCases\Authentication\Data\User;
use CicloMenstrual\UseCases\Authentication\Login;
use CicloMenstrual\UseCases\MenstrualCalendar\Data\UserMenstrualDate;
use CicloMenstrual\UseCases\MenstrualCalendar\MenstrualCalendar;
use CicloMenstrual\UseCases\MenstrualCalendar\MenstrualDateRegister;
use CicloMenstrual\UseCases\MenstrualCicle\Data\Period;
use CicloMenstrual\UseCases\MenstrualCicle\PeriodProcessor;

use function DI\autowire;

return [
    MenstrualCalendarInterface::class => autowire(MenstrualCalendar::class),
    MenstrualDateRegisterInterface::class => autowire(MenstrualDateRegister::class),
    UserMenstrualDateInterface::class => autowire(UserMenstrualDate::class),
    PeriodProcessorInterface::class => autowire(PeriodProcessor::class),
    PeriodInterface::class => autowire(Period::class),
    UserInterface::class => autowire(User::class),
    LoginInterface::class => autowire(Login::class)
];

<?php

use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\FertilePeriodInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\LutealPhaseInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\MenstruationInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicleInterface;
use CicloMenstrual\Domain\Entities\Data\MenstrualCicle;
use CicloMenstrual\Domain\Entities\Data\MenstrualCicle\FertilePeriod;
use CicloMenstrual\Domain\Entities\Data\MenstrualCicle\LutealPhase;
use CicloMenstrual\Domain\Entities\Data\MenstrualCicle\Menstruation;
use CicloMenstrual\Infrastructure\Repositories\MenstrualDateRepositoryMock;
use CicloMenstrual\Infrastructure\Session\LoggedSessionMock;
use CicloMenstrual\UseCases\Api\Authentication\Data\UserInterface;
use CicloMenstrual\UseCases\Api\Authentication\Session\LoggedSessionInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\Data\UserMenstrualDateInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualCalendarInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualDateRegisterInterface;
use CicloMenstrual\UseCases\Api\MenstrualCalendar\MenstrualDateRepositoryInterface;
use CicloMenstrual\UseCases\Api\MenstrualCicle\Data\PeriodInterface;
use CicloMenstrual\UseCases\Api\MenstrualCicle\PeriodProcessorInterface;
use CicloMenstrual\UseCases\Authentication\Data\User;
use CicloMenstrual\UseCases\MenstrualCalendar\Data\UserMenstrualDate;
use CicloMenstrual\UseCases\MenstrualCalendar\MenstrualCalendar;
use CicloMenstrual\UseCases\MenstrualCalendar\MenstrualDateRegister;
use CicloMenstrual\UseCases\MenstrualCicle\Data\Period;
use CicloMenstrual\UseCases\MenstrualCicle\PeriodProcessor;

use function DI\autowire;

return [
    /**
     * Domain
     */
    MenstrualCicleInterface::class => autowire(MenstrualCicle::class),
    FertilePeriodInterface::class => autowire(FertilePeriod::class),
    LutealPhaseInterface::class => autowire(LutealPhase::class),
    MenstruationInterface::class => autowire(Menstruation::class),

    /**
     * Use Cases
     */
    MenstrualCalendarInterface::class => autowire(MenstrualCalendar::class),
    MenstrualDateRegisterInterface::class => autowire(MenstrualDateRegister::class),
    UserMenstrualDateInterface::class => autowire(UserMenstrualDate::class),
    PeriodProcessorInterface::class => autowire(PeriodProcessor::class),
    PeriodInterface::class => autowire(Period::class),
    UserInterface::class => autowire(User::class),
    

    /**
     * Infra
     */
    LoggedSessionInterface::class => autowire(LoggedSessionMock::class),
    MenstrualDateRepositoryInterface::class => autowire(MenstrualDateRepositoryMock::class)
];
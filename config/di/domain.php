<?php

use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\FertilePeriodInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\LutealPhaseInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicle\MenstruationInterface;
use CicloMenstrual\Domain\Api\Entities\Data\MenstrualCicleInterface;
use CicloMenstrual\Domain\Entities\Data\MenstrualCicle;
use CicloMenstrual\Domain\Entities\Data\MenstrualCicle\FertilePeriod;
use CicloMenstrual\Domain\Entities\Data\MenstrualCicle\LutealPhase;
use CicloMenstrual\Domain\Entities\Data\MenstrualCicle\Menstruation;

use function DI\autowire;

return [
    MenstrualCicleInterface::class => autowire(MenstrualCicle::class),
    FertilePeriodInterface::class => autowire(FertilePeriod::class),
    LutealPhaseInterface::class => autowire(LutealPhase::class),
    MenstruationInterface::class => autowire(Menstruation::class),
];

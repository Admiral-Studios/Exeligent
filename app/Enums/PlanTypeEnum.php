<?php

namespace App\Enums;

enum PlanTypeEnum: string
{

    case SUBSCRIPTION = 'subscription';
    case ONE_TIME_CHARGE = 'one_time_charge';


    public function getTitle()
    {
        return match ($this) {
            self::SUBSCRIPTION => 'Subscription',
            self::ONE_TIME_CHARGE => 'One time charge',
        };
    }

}

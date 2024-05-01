<?php

namespace App\Enums;

enum ContactGoalEnum: string
{

    case NETWORKING = 'networking';
    case REQUEST_REFERRAL = 'request-referral';
    case JOB_OPPORTUNITY = 'job-opportunity';
    case COACHING = 'coaching';
    case RECRUITMENT = 'recruitment';
    case COLLABORATION = 'collaboration';


    public function getTitle(): string
    {
        return match ($this) {
            self::NETWORKING => 'Networking',
            self::REQUEST_REFERRAL => 'Request Referral',
            self::JOB_OPPORTUNITY => 'Job Opportunity',
            self::COACHING => 'Coaching',
            self::RECRUITMENT => 'Recruitment',
            self::COLLABORATION => 'Collaboration',
            default => ''
        };
    }

}

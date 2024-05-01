<?php

namespace App\Enums;

enum ContactStatusEnum: int
{

    case NOT_CONTACTED = 1;
    case TO_CONTACT = 2;
    case TO_FOLLOW_UP = 3;
    case MEETING_SCHEDULED = 4;
    case NOT_RESPONDED_YET = 5;


    public function getTitle(): string
    {
        return match ($this) {
            self::NOT_CONTACTED => 'Not Contacted',
            self::TO_CONTACT => 'To Contact',
            self::TO_FOLLOW_UP => 'To Follow Up',
            self::MEETING_SCHEDULED => 'Meeting Scheduled',
            self::NOT_RESPONDED_YET => 'Not Responded Yet'
        };
    }

    public function getClass(): string
    {
        return match ($this) {
            self::NOT_CONTACTED => 'not-contacted',
            self::TO_CONTACT => 'to-contact',
            self::TO_FOLLOW_UP => 'follow',
            self::MEETING_SCHEDULED => 'scheduled',
            self::NOT_RESPONDED_YET => 'not-responded',
        };
    }

}

<?php

namespace App\Enums;

enum ContactRelationshipEnum: int
{

    case STRANGER = 1;
    case CONTACT = 2;
    case PARTNER = 3;
    case FRIEND = 4;


    public function getTitle(): string
    {
        return match ($this) {
            self::STRANGER => 'Stranger',
            self::CONTACT => 'Contact',
            self::PARTNER => 'Partner',
            self::FRIEND => 'Friend',
        };
    }

}

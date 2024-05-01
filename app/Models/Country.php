<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public static function getIdByIso2($iso_a2)
    {
        return (self::where('iso_a2', $iso_a2)->first())->id ?? null;
    }

}

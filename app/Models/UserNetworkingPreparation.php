<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNetworkingPreparation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'goals',
        'helps'
    ];

    protected $casts = [
        'goals' => 'collection',
        'helps' => 'collection',
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id',
        'page'
    ];

}

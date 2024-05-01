<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExecutiveFilter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'name',
        'values',
        'is_active'
    ];

    protected $casts = [
        'values' => 'array'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

}

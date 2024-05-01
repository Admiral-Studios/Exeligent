<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageBlockTemplate extends Model
{
    use HasFactory;

    const AVAILABLE_FOR_ALL = 'all';
    const AVAILABLE_FOR_FRONT = 'front';
    const AVAILABLE_FOR_USER = 'user';

    public function scopeNotSystem($query)
    {
        return $query->where('is_system', 0);
    }

    public function scopeAvailableAll($query)
    {
        return $query->where('available_for', self::AVAILABLE_FOR_ALL);
    }

    public function scopeAvailableFront($query)
    {
        return $query->orWhere('available_for', self::AVAILABLE_FOR_FRONT);
    }

    public function scopeAvailableUser($query)
    {
        return $query->orWhere('available_for', self::AVAILABLE_FOR_USER);
    }

}

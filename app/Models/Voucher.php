<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'is_active'
    ];


    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function getUsedCountAttribute(): int
    {
        return $this->users()->count();
    }

    public function getUsesLeftAttribute(): int
    {
        return $this->uses - $this->used_count;
    }

    public static function isValid(string $code): bool
    {
        return self::active()
            ->select(['vouchers.*', 'vouchers.uses as voucher_uses'])
            ->withCount('users')
            ->having(\DB::raw('voucher_uses'), '>', \DB::raw('users_count'))
            ->whereCode($code)
            ->exists();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    use HasFactory;

    const IMAGES_PATH = 'social-links';

    public $timestamps = false;

    protected $fillable = ['is_active', 'pos', 'icon', 'url'];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

}

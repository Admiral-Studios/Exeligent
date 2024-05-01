<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterMenuSubBlock extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['is_active', 'pos', 'footer_menu_block_id'];


    protected static function booted () {
        static::deleting(function(FooterMenuSubBlock $block) {
            $block->menu()->delete();
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function menu()
    {
        return $this->hasMany(FooterMenu::class)
            ->orderBy('pos');
    }

    public function active_menu()
    {
        return $this->menu()->active();
    }

}

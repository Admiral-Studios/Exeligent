<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FooterMenuBlock extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['is_active', 'pos', 'title'];


    protected static function booted () {
        static::deleting(function(FooterMenuBlock $block) {
            if ($block->sub_blocks()) {
                foreach ($block->sub_blocks as $sub_block) {
                    $sub_block->delete();
                }
            }
        });
    }


    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function menus()
    {
        return $this->hasMany(FooterMenu::class)
            ->orderBy('pos');
    }

    public function active_menus()
    {
        return $this->menus()->active();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageBlockTab extends Model
{
    use HasFactory;

    protected $fillable = ['page_block_id', 'is_active', 'pos', 'title', 'is_highlighted'];


    protected static function booted () {

        static::deleting(function(PageBlockTab $tab) {
            if ($tab->blocks->isNotEmpty()) {
                foreach ($tab->blocks as $block)
                    $block->delete();
            }
        });

    }


    public function scopeActive($q)
    {
        return $q->where('is_active', 1);
    }

    public function blocks()
    {
        return $this->hasMany(PageBlock::class)
            ->with(['template', 'tab', 'tabs', 'tabs.blocks'])
            ->orderBy('pos');
    }

    public function activeBlocks()
    {
        return $this->hasMany(PageBlock::class)
            ->with(['template', 'tab', 'activeTabs', 'activeTabs.activeBlocks'])
            ->orderBy('pos')
            ->active();
    }

}

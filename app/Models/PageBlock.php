<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PageBlock extends Model
{
    use HasFactory;

    protected $fillable = ['page_block_tab_id', 'is_active', 'pos', 'page_id', 'page_block_template_id', 'title',
        'sub_title', 'content', 'button', 'additional_content', 'model_type', 'model_id'];

    protected $casts = [
        'button' => 'array',
        'additional_content' => 'collection'
    ];


    protected static function booted () {

        static::deleting(function(PageBlock $block) {
            if (isset($block->additional_content)) {
                if (isset($block->additional_content['img'])) {
                    if (is_array($block->additional_content['img']) && !empty($block->additional_content['img'])) {
                        foreach ($block->additional_content['img'] as $key => $img) {
                            $full_path = Page::IMAGES_PATH . '/' . $img;
                            if (Storage::exists($full_path)) {
                                $exists_in_other_models = self::where('additional_content', 'LIKE', "%{$img}%")
                                    ->whereNot('id', $block->id)
                                    ->exists();
                                if (!$exists_in_other_models)
                                    Storage::delete($full_path);
                            }
                        }
                    } else {
                        $full_path = Page::IMAGES_PATH . '/' . $block->additional_content['img'];
                        if (Storage::exists($full_path)) {
                            $exists_in_other_models = self::where('additional_content', 'LIKE', "%{$block->additional_content['img']}%")
                                ->whereNot('id', $block->id)
                                ->exists();
                            if (!$exists_in_other_models)
                                Storage::delete($full_path);
                        }
                    }
                }

                if ($block->additional_content->isNotEmpty()) {
                    foreach ($block->additional_content as $item) {
                        if (isset($item['img'])) {
                            $full_path = Page::IMAGES_PATH . '/' .$item['img'];
                            if (Storage::exists($full_path)) {
                                $exists_in_other_models = self::where('additional_content', 'LIKE', "%{$item['img']}%")
                                    ->whereNot('id', $block->id)
                                    ->exists();
                                if (!$exists_in_other_models)
                                    Storage::delete($full_path);
                            }
                        }
                    }
                }
            }

            // delete also tabs
            if ($block->tabs->isNotEmpty()) {
                foreach ($block->tabs as $tab)
                    $tab->delete();
            }

        });

    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function template()
    {
        return $this->belongsTo(PageBlockTemplate::class, 'page_block_template_id');
    }

    public function tabs()
    {
        return $this->hasMany(PageBlockTab::class)
            ->orderBy('pos');
    }

    public function activeTabs()
    {
        return $this->tabs()
            ->active();
    }

    public function tab()
    {
        return $this->belongsTo(PageBlockTab::class, 'page_block_tab_id', 'id');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function model()
    {
        return $this->morphTo('model', 'model_type', 'model_id');
    }


    public function getTitleHtmlAttribute()
    {
        return strtr($this->title, ['<' => '<span>', '>' => '</span>']);
    }

    public function getSubTitleHtmlAttribute()
    {
        return strtr($this->sub_title, ['<' => '<span>', '>' => '</span>']);
    }


}

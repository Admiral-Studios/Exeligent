<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    use HasFactory;
    use HasSlug;

    const TYPE_FRONT = 'front';
    const TYPE_USER = 'user';

    const ALL_TYPES = [
        self::TYPE_FRONT => 'Landing',
        self::TYPE_USER => 'Dashboard'
    ];


    const IMAGES_PATH = 'pages';


    const SYSTEM_ACCESSIBLE_PAGES = [
        'user.networking.*' => 'Networking'
    ];


    protected $fillable = ['is_active', 'subject', 'title', 'slug', 'img', 'type', 'name', 'show_subject'];

    protected static function booted () {

        static::deleting(function(Page $page) {
            if ($page->blocks()) {
                foreach ($page->blocks as $block) {
                    $block->delete();
                }
            }

            if ($page->img && Storage::exists(self::IMAGES_PATH . '/' . $page->img))
                Storage::delete($page->img);
        });

    }


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('subject')
            ->saveSlugsTo('slug')
            ->skipGenerateWhen(fn () => !is_null($this->slug));
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function allBlocks()
    {
        return $this->hasMany(PageBlock::class)
            ->orderBy('pos');
    }

    public function blocks()
    {
        return $this->allBlocks()
            ->whereNull('page_block_tab_id')
            ->with(['template', 'tab', 'tabs', 'tabs.blocks']);
    }

    public function blocksWithForm()
    {
        return $this->allBlocks()
            ->where('model_type', Form::class);
    }

    public function forms()
    {
        return $this->hasManyThrough(
            Form::class,
            PageBlock::class,
            'page_id',
            'id',
            'id',
            'model_id'
        )->where('model_type', Form::class);
    }

    public function activeForms()
    {
        return $this->forms()
            ->active();
    }

    public function activeBlocks()
    {
        return $this->blocks()
            ->active();
    }


    public function isSystem()
    {
        return $this->is_system == 1;
    }


    public final function getFormsPassTotalPercentage(): int
    {
        if ($this->activeForms) {
            $totalFieldsCount = 0;
            $totalFilledFieldsCount = 0;
            foreach ($this->activeForms as $form) {
                foreach ($form->rows as $row)
                    $totalFieldsCount += $row->fields()->count();

                $formService = \App\Services\FormService::create($form);
                if ($formService->isNotEmpty())
                    foreach ($form->rows as $row)
                        foreach ($row->fields as $field)
                            $totalFilledFieldsCount += $formService->getFieldValuesCount($field->id);
            }

            return round($totalFilledFieldsCount / $totalFieldsCount * 100);
        }

        return 0;
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    const ALIGN_LEFT = 'left';
    const ALIGN_RIGHT = 'right';

    const ALL_ALIGNS = [
        self::ALIGN_LEFT,
        self::ALIGN_RIGHT
    ];


    const FILES_PATH = 'form-files';


    const TYPE_INPUT = 'input';
    const TYPE_SELECT = 'select';
    const TYPE_MULTISELECT = 'multiselect';
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_FREE_FORM = 'free-form';
    const TYPE_FREE_FORM_LARGE = 'free-form-large';
    const TYPE_FAT_INPUT = 'fat-input';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_FREE_FORM_LARGE_LIMITED = 'free-form-large-limited';
    const TYPE_FREE_FORM_LARGE_SINGLE = 'free-form-large-single';
    const TYPE_FREE_FORM_LARGE_WITH_ICONS = 'free-form-large-icons';
    const TYPE_CD_FULL_WIDTH_INPUT = 'cd-full-width-input';
    const TYPE_DOC_FILE = 'doc-file';

    const ALL_TYPES = [
        self::TYPE_INPUT => 'Text input',
        self::TYPE_FAT_INPUT => 'Text full width input',
        self::TYPE_FREE_FORM => 'Free-form input',
        self::TYPE_FREE_FORM_LARGE => 'Free-form input (large)',
        self::TYPE_FREE_FORM_LARGE_LIMITED => 'Free-form input (large & limited)',
        self::TYPE_FREE_FORM_LARGE_SINGLE => 'Free-form input (large & single answer)',
        self::TYPE_FREE_FORM_LARGE_WITH_ICONS => 'Free-form input (large & emojis)',
        self::TYPE_CD_FULL_WIDTH_INPUT => 'Full width input (Career Direction)',
        self::TYPE_TEXTAREA => 'Textarea',
        self::TYPE_SELECT => 'Select from list',
        self::TYPE_MULTISELECT => 'Multiselect from list',
        self::TYPE_CHECKBOX => 'Checkbox',
        self::TYPE_DOC_FILE => 'CV file'
    ];

    protected $fillable = ['form_id', 'form_row_id', 'type', 'title', 'sub_title', 'info', 'placeholder', 'icon',
        'init_count', 'additional_placeholders', 'is_addable', 'is_sortable', 'is_full_width', 'align', 'is_title_editable', 'values_limit'];

    protected $casts = [
        'additional_placeholders' => 'array',
    ];

    protected static function booted () {

        static::deleting(function(FormField $field) {
            $field->dropValues();
        });

    }



    public function row()
    {
        return $this->belongsTo(FormRow::class, 'form_row_id');
    }

    public function values()
    {
        return $this->hasMany(FormFieldValue::class)
            ->orderBy('pos');
    }

    public function dropValues()
    {
        if ($this->values->isNotEmpty()) {
            foreach ($this->values as $value) {
                $value->delete();
            }
        }
    }

}

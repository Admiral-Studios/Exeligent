<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormRow extends Model
{
    use HasFactory;

    const TYPE_HORIZONTAL = 1;
    const TYPE_VERTICAL = 2;
    const TYPE_DIVIDER = 3;
    const TYPE_CHOOSE_HORIZONTAL = 4;
    const TYPE_CHOOSE_VERTICAL = 5;
    const TYPE_CAREER_DIRECTION_HORIZONTAL = 6;

    const ALL_TYPES = [
        self::TYPE_HORIZONTAL => 'Horizontal',
        self::TYPE_VERTICAL => 'Vertical',
        self::TYPE_DIVIDER => 'Divider',
        self::TYPE_CHOOSE_HORIZONTAL => 'Horizontal (for choose only)',
        self::TYPE_CHOOSE_VERTICAL => 'Vertical (for choose only)',
        self::TYPE_CAREER_DIRECTION_HORIZONTAL => 'Horizontal (for full width inputs on Career Direction)',
    ];

    protected $fillable = ['form_id', 'type', 'pos'];


    protected static function booted (): void
    {

        static::deleting(function(FormRow $row) {
            if ($row->fields->isNotEmpty()) {
                foreach ($row->fields as $field)
                    $field->delete();
            }
        });

    }



    public function fields(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FormField::class);
    }

}

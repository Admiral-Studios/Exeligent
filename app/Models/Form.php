<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Form extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'sub_title', 'goals', 'is_active', 'is_progressible'];

    protected $casts = [
        'goals' => 'array'
    ];

    protected static function booted (): void
    {

        static::deleting(function(Form $form) {
            if ($form->rows->isNotEmpty()) {
                foreach ($form->rows as $row)
                    $row->delete();
            }
        });

    }

    public function scopeActive($query)
    {
        return $query->where('forms.is_active', 1);
    }



    public function rows(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FormRow::class)
            ->orderBy('pos');
    }

    public function fields()
    {
        return $this->hasMany(FormField::class);
    }

    public function sortableFields()
    {
        return $this->fields()
            ->where('is_sortable', 1);
    }

    public function userData()
    {
        return $this->hasOne(UserForm::class)
            ->where('user_id', Auth::id());
    }

}

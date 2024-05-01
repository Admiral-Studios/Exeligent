<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserForm extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'form_id', 'data'];

    protected $casts = [
        'data' => 'collection'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

}

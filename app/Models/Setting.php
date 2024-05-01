<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    const IMAGES_PATH = 'settings';

    protected $fillable = ['name', 'title', 'value'];

    public static function getByName($name)
    {
        return self::where('name', $name)->firstOrFail();
    }

    public static function getValueByName($name)
    {
        return (self::getByName($name))->value ?? '';
    }

}

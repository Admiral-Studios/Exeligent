<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MayHasPage;

class HeaderMenu extends Model
{
    use HasFactory;
    use MayHasPage;

    public $timestamps = false;

    protected $fillable = ['is_active', 'pos', 'url', 'page_id', 'in_new_tab', 'title'];

}

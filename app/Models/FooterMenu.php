<?php

namespace App\Models;

use App\Traits\MayHasPage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterMenu extends Model
{
    use HasFactory;
    use MayHasPage;

    const TYPE_LINK = 1;
    const TYPE_TEL = 2;
    const TYPE_EMAIL = 3;

    const ALL_TYPES = [
        self::TYPE_LINK => 'Link',
        self::TYPE_TEL => 'Phone',
        self::TYPE_EMAIL => 'Email'
    ];

    public $timestamps = false;

    protected $fillable = ['is_active', 'in_new_tab', 'pos', 'type', 'footer_menu_block_id', 'page_id', 'url', 'title'];

}

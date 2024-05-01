<?php

namespace App\Models;

use App\Traits\MayHasPage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMenu extends Model
{
    use HasFactory;
    use MayHasPage;

    const IMAGES_PATH = 'user-menu';

    public $timestamps = false;

    protected $fillable = ['is_active', 'in_new_tab', 'pos', 'type', 'page_id', 'url', 'title', 'icon', 'active_icon'];


    public function getIconSrc(): string
    {
        return img_url(self::IMAGES_PATH . '/' . $this->icon);
    }

    public function getActiveIconSrc(): string
    {
        return img_url(self::IMAGES_PATH . '/' . $this->active_icon);
    }

}

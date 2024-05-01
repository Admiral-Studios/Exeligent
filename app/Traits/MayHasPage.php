<?php

namespace App\Traits;

use App\Models\FooterMenu;
use App\Models\Page;
use Illuminate\Support\Str;

trait MayHasPage
{

    public function hasAttribute($attr)
    {
        return array_key_exists($attr, $this->attributes);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1)
            ->where(function ($q) {
                return $q->whereNotNull('url')
                    ->orWhere(function ($q) {
                        $q->whereNotNull('page_id')
                            ->whereHas('page', function ($q) {
                                $q->active();
                            });
                    });
            });
    }


    public function page()
    {
        return $this->belongsTo(Page::class);
    }




    public function getUrlAttribute($url): string
    {
        if ($this->page) {
            if ($this->page->id == 1) // HOME PAGE???
                return route('home');

            return route('page', ['page' => $this->page->slug]);
        } else {
            if ($this->hasAttribute('type')) {
                if ($this->type == FooterMenu::TYPE_TEL) {
                    return 'tel:' . $url;
                } elseif ($this->type == FooterMenu::TYPE_EMAIL) {
                    return 'mailto:' . $url;
                } else {
                    return $url ? url($url) : '#';
                }
            } else {
                return $url ? url($url) : '#';
            }
        }
    }

    public function isPageActive(): bool
    {
        if (request()->route()?->getName() == 'home') {
            return $this->url == url()->current();
        } else {
            if ($this->page && $this->page->name === 'home') { // "/home" handle
                return request()->path() == 'home';
            } else {
                return Str::endsWith(url()->current(), $this->url)
                    || Str::contains(url()->current(), "$this->url?");
            }
        }
    }

}

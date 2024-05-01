<?php

namespace App\Services;

use App\Models\FooterMenuBlock;
use App\Models\HeaderMenu;
use App\Models\Page;
use App\Models\SocialLink;
use App\Models\UserMenu;
use App\Models\UserMenuBlock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MenuService
{

    public static function renderHeader()
    {
        $menu = HeaderMenu::active()
            ->with('page')
            ->orderBy('pos')
            ->get();

        return view('layouts.menus.header', compact('menu'));
    }

    public static function renderFooter()
    {
        $menu = FooterMenuBlock::active()
            ->whereHas('active_menus')
            ->with(['active_menus', 'active_menus.page'])
            ->orderBy('pos')
            ->get();

        return view('layouts.menus.footer', compact('menu'));
    }

    public static function renderUser()
    {
        $menus = UserMenu::active()
            ->orderBy('pos')
            ->get();

        $user = Auth::user();
        if (!($user->isAdmin() || $user->isTest())) {
            $accessible_page_ids = [];
            if ($user->currentPlanPrice) {
                $accessible_page_ids = $user->currentPlan->planAccesses()->pluck('page')->toArray();
            }
            foreach ($menus as $i => $item) {
                if ($item->page instanceof Page) {
                    if ($item->page->type == Page::TYPE_USER && !in_array($item->page->id, $accessible_page_ids))
                        $menus->forget($i);
                } else {
                    $route_name = app('router')->getRoutes()->match(app('request')->create($item->url))->getName();
                    foreach (Page::SYSTEM_ACCESSIBLE_PAGES as $page_route_name => $page_title) {
                        if (Str::is($page_route_name, $route_name)) {
                            if (!in_array($page_route_name, $accessible_page_ids))
                                $menus->forget($i);
                        }
                    }
                }
            }
        }

        return view('layouts.menus.user', compact('menus'));
    }

}

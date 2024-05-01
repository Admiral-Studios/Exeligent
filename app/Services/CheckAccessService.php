<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckAccessService
{

    public static function check($page): bool
    {
        $request = request();
        if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isTest()))
            return true;

        $current_plan = null;

        if (Auth::check() && Auth::user()->hasSubscription())
            $current_plan = Auth::user()->currentPlan;

        if ($page instanceof Page) {
            if ($page->type == Page::TYPE_FRONT)
                return true;

            if ($current_plan) {
                $accessible_pages = $current_plan
                    ->planAccesses()
                    ->pluck('page')
                    ->toArray();
                if (in_array($page->id, $accessible_pages))
                    return true;
            }

            return false;
        } else {
            foreach (array_keys(Page::SYSTEM_ACCESSIBLE_PAGES) as $system_page_route) {
                if (Str::is($system_page_route, $request->route()->getName())) {
                    if ($current_plan) {
                        $accessible_pages = $current_plan
                            ->planAccesses()
                            ->pluck('page')
                            ->toArray();
                        if (in_array($system_page_route, $accessible_pages))
                            return true;
                    }

                    return false;
                }
            }
        }

        return false;
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Plan;
use App\Services\PageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    public function __construct(private PageService $pageService)
    {
    }

    public function index(Request $request, Page $page)
    {
        if (
            !$page->exists &&
            ($request->getRequestUri() === '/' || str_contains($request->getRequestUri(), '/?'))
        ) {
            $page = Page::first();
        }

        if ($page->exists && $page->is_active) {
            if ($page->type == Page::TYPE_USER && !Auth::check())
                return redirect('/');

            return view("page.index", [
                'page' => $page->load(['allBlocks']),
                'pageService' => $this->pageService,
                'bodyClass' => $page->name . '-front',
            ]);
        }

        abort(404);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Executive;
use App\Services\ExecutiveSearchService;
use Illuminate\Http\Request;

class ExecutiveSearchController extends Controller
{

    public function __construct(private ExecutiveSearchService $searchService)
    {
    }

    public function index(Request $request)
    {
        return view('user.search.index', [
            'properties' => $this->searchService->getProperties(),
            'executives' => $this->searchService->getExecutives($request->all()),
            'filter_properties' => $this->searchService->filter_properties,
        ]);
    }

    public function show(Request $request, Executive $executive)
    {
        if ($request->ajax())
            return view('user.search.includes.show', compact('executive'))->render();

        return view('user.search.show', [
            'executive' => $executive
        ]);
    }

}

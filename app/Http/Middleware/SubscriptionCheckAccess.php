<?php

namespace App\Http\Middleware;

use App\Models\Page;
use App\Models\PlanAccess;
use App\Services\CheckAccessService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionCheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (CheckAccessService::check($request->page))
            return $next($request);
        else
            return to_route('user.profile')
                ->with('error', 'You do not have access to this page');
    }
}

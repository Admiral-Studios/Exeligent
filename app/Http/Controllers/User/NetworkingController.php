<?php

namespace App\Http\Controllers\User;

use App\Enums\ContactStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Services\NetworkingService;
use Illuminate\Http\Request;

class NetworkingController extends Controller
{

    public function __construct(private NetworkingService $networkingService)
    {
    }

    public function index()
    {
        return view('page.networking-funnel', [
            'funnel_counts' => $this->networkingService->getFunnelCounts(),
            'funnel' => $this->networkingService->getFunnel(),
            'contacts' => $this->networkingService->getContacts(),
            'user_networking_preparation' => $this->networkingService->getUserPreparation(),
            'filters' => $this->networkingService->getFilters(),
            'is_user_has_any_contacts' => \Auth::user()->contacts()->exists()
        ]);
    }

    public function userPreparation(Request $request)
    {
        $request->validate([
            'goals' => ['array', 'nullable'],
            'helps' => ['array', 'nullable'],
        ]);

        \Auth::user()->networkingPreparation->update($request->post());

        return back()->with('success', 'Data successfully saved');
    }

    public function editContact(Request $request, Contact $contact)
    {
        if ($request->ajax())
            return view('user.networking._edit', compact('contact'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequestRequest;
use App\Models\ContactRequest;

class ContactRequestController extends Controller
{

    public function store(ContactRequestRequest $request)
    {
        try {
            ContactRequest::create($request->validated());
            return back()->with('success', 'Thank you for your request. We will get back to you soon');
        } catch (\Exception $exception) {
            return back()->with('error', 'ERROR!');
        }
    }

}

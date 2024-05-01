<?php

namespace App\Http\Controllers\User;

use App\Exports\ContactsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\ContactsImportRequest;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{

    public function __construct(private ContactService $contactService)
    {
    }

    public function import(ContactsImportRequest $request)
    {
        if ($this->contactService->import(auth()->id(), $request->validated()))
            return redirect()->route('user.networking.index')
                ->with('success', 'Connections are successfully synchronized');

        return back();
    }

    public function exportXlsx(Request $request)
    {
        return Excel::download(new ContactsExport(), 'contacts.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function exportCsv(Request $request)
    {
        return Excel::download(new ContactsExport(), 'contacts.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function edit(Request $request, Contact $contact)
    {
        $this->authorize('update', $contact);

        if ($ajax = $request->ajax())
            return view('user.contacts.includes._edit', compact('contact', 'ajax'));

        return view('user.contacts.edit', compact('contact', 'ajax'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $this->contactService->store($request->validated());

        if ($contact)
            return redirect()
                ->route('user.networking.index', ['contact' => $contact->id])
                ->with('success', 'Contact successfully saved');

        return back();
    }

    public function update(ContactRequest $request, Contact $contact)
    {
        $this->authorize('update', $contact);

        $contact = $this->contactService->update($request->validated(), $contact);

        if ($contact) {
            if ($request->wantsJson())
                return new JsonResponse(['result' => true, 'item' => $contact]);

            return redirect()
                ->route('user.networking.index', $contact)
                ->with('success', 'Contact successfully updated');
        } else {
            if ($request->wantsJson())
                return new JsonResponse(['result' => false]);

            return back();
        }
    }

    public function destroy(Request $request, Contact $contact)
    {
        $result = $contact->delete();

        if ($result) {
            activity('contacts')
                ->log("User deleted contact (ID:{$contact->id})");

            if ($request->wantsJson())
                return new JsonResponse(compact('result'));

            return redirect()->route('user.networking.index')->with('success', 'Contact successfully deleted');
        }

        return back()->with('error', 'ERROR!');
    }

}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Page;
use App\Models\UserForm;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $custom_forms = Auth::user()->forms;
        $form_pages = Page::whereHas('activeForms')
            ->with('activeForms')
            ->get();

        return view('user.dashboard.index', [
            'form_pages' => $form_pages,
            'custom_forms' => $custom_forms,
        ]);
    }

    public function export()
    {
        $form_pages = Page::whereHas('activeForms')
            ->with('activeForms')
            ->get();

        $pdf = Pdf::loadView('user.dashboard._pdf', [
            'form_pages' => $form_pages,
        ])->setPaper('a4');

        return $pdf->download('dashboard.pdf');
    }

}

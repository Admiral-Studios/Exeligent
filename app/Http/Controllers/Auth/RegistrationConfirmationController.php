<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistrationConfirmationController extends Controller
{

    public function index()
    {
        \Auth::user()->update(['is_registration_confirmed' => 1]);

        return view('auth.register-confirmation');
    }

}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/');
        }

        $existing_user = User::where('email', $user->email)->first();
        if($existing_user){
            auth()->login($existing_user, true);
        } else {
            list($first_name, $last_name) = explode(' ', $user->name);
            $new_user = new User;
            $new_user->first_name = $first_name ?? '';
            $new_user->last_name = $last_name ?? '';
            $new_user->email = $user->email;
            $new_user->google_id = $user->id;
            $new_user->password = Hash::make(Str::random(8));
            $new_user->save();
            auth()->login($new_user, true);
        }

        return redirect()->to($this->redirectTo);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
        activity('login')
            ->log('Successful Log In');

        if (Str::contains(url()->previous(), 'admin') && $user->isAdmin())
            return redirect()->route('admin.dashboard');
        else
            return redirect()->intended($this->redirectPath());
    }


    public function loggedOut(Request $request)
    {
        if (Str::contains(url()->previous(), 'admin'))
            return redirect()->route('admin');
        else
            return redirect()->route('home');
    }

}

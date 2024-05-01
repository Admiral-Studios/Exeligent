<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\PlanService;
use App\Services\SettingService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::REGISTER_SECOND_STEP;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        if (!SettingService::canRegister())
            abort(503);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
            'position' => ['nullable', 'string', 'max:255'],
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'position' => $data['position'] ?? null
        ]);
    }

    protected function registered(Request $request, $user)
    {
        \Auth::login($user);

        activity('signup')
            ->causedBy($user)
            ->log('Account created');

//        $request
//            ->session()
//            ->flash('success', 'The registration was successful. Please confirm your email by following the instructions in the email we sent you');
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user_data = $request->all();

        event(new Registered($user = $this->create($user_data)));

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse(['redirect_url' => redirect()->to($this->redirectPath())])
            : redirect($this->redirectPath());
    }

}

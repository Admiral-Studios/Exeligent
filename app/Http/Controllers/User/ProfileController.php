<?php

namespace App\Http\Controllers\User;

use App\Exports\InvoicesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Country;
use App\Models\Plan;
use App\Models\User;
use App\Services\PlanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $subscription = Auth::user()->activeSubscription;
        $user_payment_methods = $user->paymentMethods();
        $user_default_payment_method = $user->defaultPaymentMethod();
        $stripe_key = env('STRIPE_KEY');
        $intent = Auth::user()->createSetupIntent();
        $plans = (new PlanService())->getAllActive();

        return view('user.profile.index',
            compact('user', 'subscription', 'user_payment_methods', 'user_default_payment_method',
                'stripe_key', 'intent', 'plans'));
    }

    public function store(ProfileRequest $request)
    {
        $data = $request->post();
        $data['country_id'] = Country::getIdByIso2($data['country']);
        unset($data['country']);
        $user = Auth::user();

        if ($user->update($data)) {
            activity('update')
                ->log('Updated profile information');
            return back()->with('success', 'Your profile has been successfully updated');
        } else {
            return back()->with('error', 'An error occurred while trying to save data');
        }
    }


    public function searchCity(Request $request)
    {
        $q = $request->post('q');
        $country = $request->post('country');

        $response = Http::get('http://api.geonames.org/searchJSON', [
            'name' => $q,
            'maxRows' => 10,
            'country' => $country,
            'cities' => 'cities1000',
            'isNameRequired' => true,
            'username' => env('GEONAMES_USERNAME')
        ]);
        $result = $response->json();

        $cities = [];

        if (isset($result['geonames'])) {
            foreach ($result['geonames'] as $city) {
                $cities[] = [
                    'title' => $city['name']
                    . ($city['adminName1'] && $city['adminName1'] != $city['name'] ? ', ' . $city['adminName1'] : ''),
                    'city' => $city['name'],
                    'state' => $city['adminName1']
                ];
            }
        }
        return response()->json($cities);
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        try {
            if (Hash::check($request->post('password'), $user->password)) {
                if ($user->delete()) {
                    $user->activeSubscription?->cancel();

                    activity('profile')
                        ->log('User deleted account');

                    Auth::logout();

                    return redirect()->route('home');
                }
            }
        } catch (\Exception $exception) {

        }

        return back()->with('error', 'Failed to delete your profile!');
    }

    public function acceptTest()
    {
        $user = Auth::user();

        $user->role_id = User::ROLE_TEST;
        $user->is_wanna_test = 1;
        $user->save();

        return back()->with('success', 'You get the test access to all features!');
    }

    public function rejectTest(Request $request)
    {
        $user = Auth::user();

        $user->is_wanna_test = 0;
        $user->save();

        if ($request->wantsJson())
            return ['result' => true];

        return back();
    }

    public function downloadInvoices()
    {
        return new InvoicesExport();
    }

}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;

class PaymentMethodController extends Controller
{

    public function update(Request $request)
    {
        $user = \Auth::user();

        try {
            $stripe_payment_method_id = $request->post('payment_method_id');
            if (!$stripe_payment_method_id) {
                $stripePaymentMethod = $user->addPaymentMethod($request->post('token'));
            } else {
                $stripePaymentMethod = Cashier::stripe()->paymentMethods->retrieve($stripe_payment_method_id);
            }

            if (!$stripePaymentMethod)
                throw new Exception('An error occurred while trying to retreive payment method. Please try again');

            $address = $stripePaymentMethod->billing_details->address->postal_code . ' '
                . $stripePaymentMethod->billing_details->address->line1 . ', '
                . $stripePaymentMethod->billing_details->address->city . ', '
                . $stripePaymentMethod->billing_details->address->state;

            $user->updateDefaultPaymentMethod($stripePaymentMethod->id);
            $user->update([
                'pm_cardholder_name' => $stripePaymentMethod->billing_details->name,
                'pm_billing_address' => $address
            ]);

            return back()->with('success', 'Payment Method successfully updated');
        } catch (Exception $exception) {
            return back()->with('error', 'ERROR! ' . $exception->getMessage());
        }
    }

}

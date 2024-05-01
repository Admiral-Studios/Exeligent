<?php

namespace App\Http\Requests\Register;

use App\Models\Voucher;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{

    public $billingDetailsRequired =  true;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $voucher_code = session()->get('voucher_code');
        if ($voucher_code && Voucher::isValid($voucher_code))
            $this->billingDetailsRequired = false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->billingDetailsRequired
            ? [
                'cardholder_name' => ['required', 'string'],
                'state' => ['required', 'string'],
                'city' => ['required', 'string'],
                'address_1' => ['required', 'string'],
                'token' => ['required', 'string'],
                'policy' => ['accepted']
            ]
            : [
                'policy' => ['accepted']
            ];
    }
}

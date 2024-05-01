<?php

namespace App\Http\Requests\Register;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChoosePlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'plan_price' => [
                'required',
                \request('plan_price') !== 'test'
                    ? Rule::exists('plan_prices', 'id')->where('is_active', 1)
                    : Rule::in(['test'])
            ]
        ];
    }
}

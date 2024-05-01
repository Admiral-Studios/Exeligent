<?php

namespace App\Http\Requests;

use App\Enums\ContactGoalEnum;
use App\Enums\ContactRelationshipEnum;
use App\Enums\ContactStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'contact_method' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'relationship' => ['nullable', Rule::enum(ContactRelationshipEnum::class)],
            'contacted_at' => ['nullable', 'date'],
            'status' => ['nullable', Rule::enum(ContactStatusEnum::class)],
            'goal' => ['nullable', Rule::enum(ContactGoalEnum::class)],
            'notes' => ['nullable', 'string'],
        ];
    }

}

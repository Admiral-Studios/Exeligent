<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;

class ContactsImportRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'import_connections' => ['nullable', File::types(['csv', 'txt'])->max(10 * 1024)],
            'first_name.*' => ['nullable', 'string', 'max:255'],
            'last_name.*' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function attributes()
    {
        return array_merge([
            'import_connections' => 'Import Connections',
            'first_name.*' => 'First Name',
            'last_name.*' => 'Last Name',
        ], parent::attributes());
    }

}

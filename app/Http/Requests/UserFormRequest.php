<?php

namespace App\Http\Requests;

use App\Models\FormField;
use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends BaseFormRequest
{

    public $custom_attributes;

    public function __construct()
    {
        $custom_form_attributes = FormField::all();
        $attributes = [];
        foreach ($custom_form_attributes as $field)
            if ($field->type == FormField::TYPE_FREE_FORM_LARGE_WITH_ICONS)
                $attributes["data.{$field->id}.*.*"] = ['nullable', 'string', 'max:255'];
            elseif($field->type == FormField::TYPE_DOC_FILE)
                $attributes["data.{$field->id}.*"] = ['nullable', 'file'];
            else
                $attributes["data.{$field->id}.*"] = ['nullable', 'string', 'max:255'];

        $this->custom_attributes = $attributes;
    }

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [];
        foreach ($this->custom_attributes as $key => $custom_rules)
            $rules[$key] = $custom_rules;

        return $rules;
    }

    public function attributes()
    {
        return array_merge($this->custom_attributes, parent::attributes());
    }

}

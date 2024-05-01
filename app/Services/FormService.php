<?php

namespace App\Services;

use App\Models\Form;
use App\Models\FormField;
use App\Models\UserForm;
use Illuminate\Support\Facades\Auth;


class FormService
{

    public $form;
    public $user_form_data;

    public function __construct(Form $form)
    {
        $this->form = $form->with('fields')->first();
        $this->user_form_data = $form->userData->data ?? null;
    }


    public function getFieldLabel($field_id, $default = ''): string
    {
        if ($this->user_form_data)
            return $this->user_form_data['custom_labels'][$field_id] ?? $default;

        return $default;
    }

    public function getFieldValues($field_id, $field_type = null, bool $as_html = true): array
    {
        if ($this->user_form_data) {
            if ($field_type == FormField::TYPE_DOC_FILE) {
                $data = $this->user_form_data[$field_id] ?? [];
                return array_map(function ($item) use($as_html) {
                    if (isset($item['file_name'])) {
                        $url = route('user.form.file.show', $item['title']);
                        if ($as_html)
                            return "<a href='{$url}' target='_blank'>{$item['title']}</a>";
                        else
                            return $item['title'];
                    }
                    return '';
                }, $data);
            } else {
                return $this->user_form_data[$field_id] ?? [];
            }
        }

        return [];
    }

    public function getFieldValue($field_id, $i)
    {
        if ($this->user_form_data)
            return $this->user_form_data[$field_id][$i] ?? null;

        return null;
    }

    public function getFieldValuesCount($field_id): int
    {
        return count($this->getFieldValues($field_id));
    }


    public final function isEmpty(): bool
    {
        if ($this->user_form_data)
            return $this->user_form_data->filter()->isEmpty() ?? true;

        return true;
    }

    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    public static function create(Form $form): self
    {
        return new self($form);
    }

    public static function userHasSomeForms($form_ids)
    {
        return UserForm::where('user_id', Auth::id())
            ->whereIn('form_id', $form_ids)
            ->exists();
    }

    public function getFieldFiles($field_id)
    {
        $files = $this->getFieldValues($field_id);
        $result = [];

        foreach ($files as $file) {
            $result[] = [
                'title' => $file['title'] ?? '',
                'file_name' => $file['file_name'],
                'url' => \Illuminate\Support\Facades\Storage::url(FormField::FILES_PATH . '/' . $file['file_name'])
            ];
        }

        return $result;
    }

    public function getFileTitle($field_id, $i)
    {
        $file = $this->getFieldValue($field_id, $i);
        return $file['title'] ?? '';
    }

    public function getFileUrl($field_id, $i)
    {
        $file = $this->getFieldValue($field_id, $i);
        if ($file && isset($file['file_name']))
            return \Illuminate\Support\Facades\Storage::url(FormField::FILES_PATH . '/' . $file['file_name']);

        return null;
    }


    public static function mutate($field)
    {
        $type = 'string';

        if (str_contains($field, 'mutate:')) {
            [$mutate, $type, $value] = explode(':', $field);
        } else {
            $value = $field;
        }

        return match ($type) {
            'bool' => boolval($value),
            default => $value,
        };
    }

    public function __toString(): string
    {
        $out = $this->form->title . ' - ';

        foreach ($this->form->rows as $row) {
            foreach ($row->fields as $field) {
                if ($this->getFieldValuesCount($field->id) > 0)
                    $out .= $field->title . ': ' . implode(', ', $this->getFieldValues($field->id, $field->type, false)) . '; ';
            }
        }

        return $out;
    }

}

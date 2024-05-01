<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\Form;
use App\Models\FormField;
use App\Models\UserForm;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class FormController extends Controller
{

    public function store(UserFormRequest $request, Form $form)
    {
        try {
            $userForm = UserForm::firstOrCreate([
                'user_id' => Auth::id(),
                'form_id' => $form->id
            ]);

            $data = $request->post('data', []);

            $custom_labels = $data['custom_labels'] ?? [];
            $data = array_map(function ($items) {
                return array_values(array_filter($items));
            }, $data);
            $data['custom_labels'] = $custom_labels;

            if ($userForm->data && $userForm->data->isNotEmpty()) {
                foreach ($userForm->data as $field => $fieldData) {
                    if (is_array($fieldData)) {
                        foreach ($fieldData as $fieldDatum) {
                            if (is_array($fieldDatum) && isset($fieldDatum['file_name']))
                                Storage::delete(FormField::FILES_PATH . '/' . $fieldDatum['file_name']);
                        }
                    }
                }
            }
            foreach ($request->allFiles()['data'] ?? [] as $field_id => $files) {
                foreach ($files as $file) {
                    if (Storage::put(FormField::FILES_PATH, $file)) {
                        $data[$field_id][] = [
                            'title' => $file->getClientOriginalName(),
                            'file_name' => $file->hashName()
                        ];
                    }
                }
            }

            $userForm->update(['data' => $data]);
            activity('update')
                ->log("Updated information in the form: {$form->title}");

            return back()->with('success', 'Data has been successfully saved');
        } catch (Exception $e) {
            return back()->with('error', 'ERROR!');
        }
    }


    public function showFile(Request $request, $title)
    {
        $formData = Auth::user()->forms()->where('data', 'LIKE',  "%$title%")->firstOrFail();
        foreach ($formData['data'] as $key => $formDatum) {
            if (is_array($formDatum)) {
                foreach ($formDatum as $formFieldValue) {
                    if (isset($formFieldValue['title']) && isset($formFieldValue['file_name'])) {
                        if ($formFieldValue['title'] == $title)
                            return redirect(Storage::url(FormField::FILES_PATH . '/' . $formFieldValue['file_name']));
                    }
                }
            }
        }

        abort(404);
    }

    private function getHumanSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

}

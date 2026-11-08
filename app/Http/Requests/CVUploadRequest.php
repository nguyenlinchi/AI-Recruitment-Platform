<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CVUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ];
    }
}
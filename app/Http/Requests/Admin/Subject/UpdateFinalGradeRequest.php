<?php

namespace App\Http\Requests\Admin\Subject;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFinalGradeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "final_grade" => 'required|decimal:0',
        ];
    }

    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }
}
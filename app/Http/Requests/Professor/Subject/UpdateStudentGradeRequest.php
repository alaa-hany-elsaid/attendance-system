<?php

namespace App\Http\Requests\Professor\Subject;

use App\Helpers\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentGradeRequest extends FormRequest
{
    use ValidationTrait;

    public function rules(): array
    {
        return [
            'attendance_grade' => 'decimal:0',
            'project_grade'    => 'decimal:0',
            'midterm_grade'    => 'decimal:0',
        ];
    }


    public function authorize(): bool
    {
        return auth()->user()->isProfessor();
    }
}
<?php

namespace App\Http\Requests\Professor\Lecture;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttendanceStateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'attended' => 'required|bool',
        ];
    }

    public function authorize(): bool
    {
        return auth()->user()->isProfessor() && $this->route('lecture')->subject->user_id == auth()->user()->id;
    }
}
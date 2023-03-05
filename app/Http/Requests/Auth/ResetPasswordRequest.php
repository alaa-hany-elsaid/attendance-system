<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'    => 'required|email|exists:password_reset_tokens',
            'code'     => 'required|string|exists:password_reset_tokens,token',
            'password' => 'required|confirmed|min:8',
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AuthUserRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "email" => "required|email",
            "token" => "required|min:5"
        ];
    }

    public function messages(): array
    {
        return [
            'email' => [
                'required' => "Por favor insira um email.",
                'email' =>"Email inválido."
            ],
            'token' => [
                'required' => 'Por favor insira seu token.',
                'min' => 'O token deve ter pelo menos :min caracteres.'
            ]
        ];
    }
}

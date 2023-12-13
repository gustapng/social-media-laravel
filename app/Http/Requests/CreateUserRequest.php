<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
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
            "name"     => "required|string",
            "email"    => "required|email|unique:users,email|",
            "password" => [
                'required',
                'string',
                Password::min(8)
                ->numbers()
                ->symbols(),
                'confirmed'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Por favor insira seu nome.',
            'email' => [
                'required' => "Por favor insira um email.",
                'unique'   => "Email já cadastrado.",
                'email'    =>"Por favor insira um endereço de email válido."
            ],
            'password' => [
                'required'  => 'Por favor insira uma senha.',
                'min'       => 'A senha deve ter pelo menos :min caracteres.',
                'letters'   => 'A senha deve ter ao menos uma letra.',
                'numbers'   => 'A senha deve ter ao menos um número.',
                'symbols'   => 'A senha deve ter ao menos um caractere especial.',
                'confirmed' => 'A confirmação da senha não corresponde.',
            ]

        ];

    }
}

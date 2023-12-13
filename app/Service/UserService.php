<?php

namespace App\Service;

use App\Helpers\Pattern;
use Carbon\Carbon;
use App\Mail\AuthEmail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class UserService
{
    public function login($data):array
    {
        $user = User::where('email', $data['email'])->first();

        if ($user == null || !Hash::check($data['password'], $user->password)) {
            //dd("aqui");
            return Pattern::responseJsonDefault("error", "E-mail ou senha inválidos.");
        }

        return Pattern::responseJsonDefault("success", "Usuário cadastrado com sucesso! Confirme no e-mail.");
    }

    public function registerUser($data):array
    {
        $data['token'] = Str::random(5);
        $user = User::create($data);

        if ($user) {
            $email = new AuthEmail(ucfirst($data['name']), $data['email'], $data['token']);
            Mail::to($data['email'])->send($email);
        }

        return Pattern::responseJsonDefault("success", "Usuário cadastrado com sucesso! Confirme no e-mail.");
    }

    public function authUser($data):array
    {
//      TODO VERIFICAR TODA A LÓGICA E MUDAR PARA A CAMADA CORRETA (POLICES)
        $user = User::where('email', $data['email'])->first();

        if ($user == null) {
            return Pattern::responseJsonDefault("error", "E-mail não cadastrado.");
        }
        else if ($user['auth_email'] == 1) {
            return Pattern::responseJsonDefault("error", "E-mail já autenticado.");
        }
        else if ($user['token'] != $data['token']) {
            return Pattern::responseJsonDefault("error", "Token incorreto.");
        }

        User::where('email', $data['email'])->update(['auth_email' => 1, 'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s')]);
        return Pattern::responseJsonDefault("success", "Usuário autenticado com sucesso! Faça seu primeiro login");
    }
}

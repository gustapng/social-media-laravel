<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Service\UserService;
use Illuminate\View\View;

class RegisterController extends Controller
{

    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function registerAction(CreateUserRequest $request):View
    {

        $this->userService->registerUser($request->all());

        return view('register', array("success" => "Usuário cadastrado com sucesso!"));
    }
}

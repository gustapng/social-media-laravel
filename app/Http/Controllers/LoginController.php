<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\LoginRequest;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class loginController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }
    public function loginAction(LoginRequest $request):View
    {
        $response = $this->userService->login($request->all());

        if ($response['status'] == "error") {
            return view('welcome')->withErrors($response['message']);
        }

        return view('home')->with($response['status'], $response['message']);
    }
}

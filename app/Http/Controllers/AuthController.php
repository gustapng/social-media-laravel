<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function authAction(AuthUserRequest $request):View
    {
        $response = $this->userService->authUser($request->all());

        if ($response['status'] == "error") {
            return view('auth')->withErrors($response['message']);
        }

        return view('welcome')->with($response['status'], $response['message']);
    }
}

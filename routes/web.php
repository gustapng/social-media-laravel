<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registrar', function () {
    return view('register');
});

Route::get('/autenticar', function () {
    return view('auth');
});

Route::middleware(['web'])->group(function () {
    Route::post('/login', [LoginController::class, 'loginAction']);
});

Route::middleware(['web'])->group(function () {
    Route::post('/register-user', [RegisterController::class, 'registerAction']);
});

Route::middleware(['web'])->group(function () {
    Route::post('/auth-user', [AuthController::class, 'authAction']);
});

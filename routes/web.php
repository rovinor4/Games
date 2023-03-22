<?php

use App\Http\Controllers\AccountUser;
use App\Http\Controllers\ScoreController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Route::middleware("auth")->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name("HOME");
    Route::get('/top-rank', function () {
        $Data = User::orderBy('score', 'Desc')->take(10)->get();
        return view("Rangking", [
            "Data" => $Data
        ]);
    });
    Route::get('/akun', function () {
        return view('akun', ["Data" => Auth()->user()]);
    })->name("akun");

    Route::get('/LogOut', [AccountUser::class, "logout"])->name("LogOut");
});

Route::prefix("/score")->group(function () {
    Route::get('get', [ScoreController::class, "get"]);
    Route::get('update', [ScoreController::class, "update"]);
})->middleware("auth");

Route::middleware("guest")->group(function () {
    Route::get('/login', function () {
        return view('Login');
    })->name("login");

    Route::post('/login', [AccountUser::class, "authenticate"])->name("loginPost");
    Route::post('/register', [AccountUser::class, "CreateUser"])->name("registerPost");

    Route::get('/register', function () {
        return view('Register');
    })->name("register");
});

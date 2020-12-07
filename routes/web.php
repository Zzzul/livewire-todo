<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Logout;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Todo;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');

    Route::get('/', function () {
        return view('welcome');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('todo', Todo::class);
    Route::get('logout', Logout::class)->name('logout');
});

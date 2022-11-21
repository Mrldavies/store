<?php

use Illuminate\Support\Facades\Route;


Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');

Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

Route::post('logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');

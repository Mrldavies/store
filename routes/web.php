<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get(
    '/',
    [App\Http\Controllers\DashboardController::class, 'index']
)->middleware(['auth:supplier'])
    ->name('dashboard');

Route::resource('product', App\Http\Controllers\ProductController::class)
    ->middleware(['auth:supplier']);

Route::resource('blog', App\Http\Controllers\BlogController::class)
    ->middleware(['auth:supplier']);


require __DIR__ . '/auth.php';

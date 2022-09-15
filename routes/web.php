<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('office', App\Http\Controllers\OfficeController::class)->only([
        'index', 'create', 'store', 'edit', 'update'
    ]);

    Route::resource('file', App\Http\Controllers\FileController::class)->only([
        'index', 'create', 'store', 'edit', 'update'
    ]);

    Route::resource('user', App\Http\Controllers\UserController::class)->only([
        'index'
    ]);
});

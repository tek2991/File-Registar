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
        'index', 'show', 'create', 'store', 'edit', 'update'
    ]);

    Route::resource('movement', App\Http\Controllers\MovementController::class)->only([
        'index',
    ]);

    Route::resource('user', App\Http\Controllers\UserController::class)->only([
        'index'
    ]);


    Route::get('barcode', [App\Http\Controllers\BarcodeController::class, 'index'])->name('barcode.index');
    Route::post('barcode/generate', [App\Http\Controllers\BarcodeController::class, 'generate'])->name('barcode.generate');
    
    Route::get('receive-other-files/{file}', [App\Http\Controllers\ReceiveOtherFilesController::class, 'index'])->name('receive-other-files.index');
    Route::post('receive-other-files/{file}', [App\Http\Controllers\ReceiveOtherFilesController::class, 'store'])->name('receive-other-files.store');

    Route::put('file-receive/{file}', [App\Http\Controllers\FileMovementController::class, 'receiveUpdate'])->name('file.receive.update');
    Route::get('file-dispatch/{file}', [App\Http\Controllers\FileMovementController::class, 'dispatchView'])->name('file.dispatch');
    Route::put('file-dispatch/{file}', [App\Http\Controllers\FileMovementController::class, 'dispatchUpdate'])->name('file.dispatch.update');
});

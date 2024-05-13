<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ActivityController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['role:user']);

Route::post('manageActivity/{activity}/participate', [ActivityController::class, 'participate'])
    ->name('manageActivity.participate');

Route::resources([
    'manageActivity' => ActivityController::class,
]);

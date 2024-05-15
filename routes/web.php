<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TeacherController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();
//return home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
//ADMIN
//Admin view teacher account register page 
// Route::get('/teacherAccount',[App\Http\Controllers\TeacherController::class,'index']);

// Route::post('manageTeacherAccount/{user}/')



//

Route::post('manageActivity/{activity}/participate', [ActivityController::class, 'participate'])
    ->name('manageActivity.participate');

Route::resources([
    'manageActivity' => ActivityController::class,
    'manageAccountRegistration' => TeacherController::class,
]);

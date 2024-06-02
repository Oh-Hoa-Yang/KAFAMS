<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();
//return home
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('students/admin', [StudentController::class, 'indexAdmin'])->name('students.indexAdmin'); //Don't shift this to the group function

//

Route::post('manageActivity/{activity}/participate', [ActivityController::class, 'participate'])
    ->name('manageActivity.participate');

Route::resources([
    'manageActivity' => ActivityController::class,
    'manageAccountRegistration' => TeacherController::class,
    'manageStdIDVerification' => StudentController::class,
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('students', StudentController::class);
    //AdminIndex
});

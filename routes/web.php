<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentResultController;
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

Route::get('manageStudentResult/viewStudentResult', [StudentResultController::class, 'viewStudentResult'])->name('manageStudentResult.viewStudentResult');
Route::get('manageStudentResult/viewSubjectList', [StudentResultController::class, 'viewSubjectList'])->name('manageStudentResult.viewSubjectList');
Route::delete('manageStudentResult/deleteSubject/{id}', [StudentResultController::class, 'deleteSubject'])->name('manageStudentResult.deleteSubject');
Route::post('manageStudentResult/new-subject', [StudentResultController::class, 'storeNewSubject'])->name('manageStudentResult.storeNewSubject');
Route::get('manageStudentResult/new-subject', [StudentResultController::class, 'newSubject'])->name('manageStudentResult.newSubject');
Route::post('manageStudentResult/addResult', [StudentResultController::class, 'addResult'])->name('manageStudentResult.addResult');
Route::get('manageStudentResult/viewStudentList', [StudentResultController::class, 'viewStudentList'])->name('manageStudentResult.viewStudentList');
Route::get('manageStudentResult/editResult', [StudentResultController::class, 'editResult'])->name('manageStudentResult.editResult');
Route::post('manageStudentResult/updateResult', [StudentResultController::class, 'updateResult'])->name('manageStudentResult.updateResult');

Route::resources([
    'manageActivity' => ActivityController::class,
    'manageAccountRegistration' => TeacherController::class,
    'manageStdIDVerification' => StudentController::class,
    'manageStudentResult' => StudentResultController::class,
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('students', StudentController::class);
    //AdminIndex
});

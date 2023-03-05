<?php

use App\Http\Controllers\API\Admin\AdminProfessorController;
use App\Http\Controllers\API\Admin\AdminStudentController;
use App\Http\Controllers\API\Admin\AdminSubjectController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\ResetPasswordController;
use App\Http\Controllers\API\Professor\ProfessorLectureController;
use App\Http\Controllers\API\Professor\ProfessorStudentController;
use App\Http\Controllers\API\Professor\ProfessorSubjectController;
use App\Http\Controllers\API\Student\StudentProfessorController;
use App\Http\Controllers\API\Student\StudentSubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/login', [LoginController::class, 'signIn'])->name('login');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password-reset.reset');
Route::post('/reset-password/send-code', [ResetPasswordController::class, 'sendCode'])
    ->name('password-reset.send-code');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::prefix('/admin')->name('admin.')->group(function () {

        Route::prefix('/students')->name('students.')->group(function () {
            Route::get('/', [AdminStudentController::class, 'index'])->name('index');
            Route::get('/{user}', [AdminStudentController::class, 'view'])->name('view');
        });
        Route::prefix('/professors')->name('professors.')->group(function () {
            Route::get('/', [AdminProfessorController::class, 'index'])->name('index');
            Route::get('/{user}', [AdminProfessorController::class, 'view'])->name('view');
        });
        Route::prefix('/subjects')->name('subjects.')->group(function () {
            Route::get('/', [AdminSubjectController::class, 'index'])->name('index');
            Route::get('/lectures/{subject}', [AdminSubjectController::class, 'getLectures'])->name('lectures');
            Route::get('/{subject}', [AdminSubjectController::class, 'view'])->name('view');
            Route::post('/{subject}/students/{user}', [AdminSubjectController::class, 'updateFinalGrade'])
                ->name('update-final-grade');
        });

    });

    Route::prefix('/professor')->name('professor.')->group(function () {
        Route::prefix('/subjects')->name('subjects.')->group(function () {
            Route::get('/', [ProfessorSubjectController::class, 'index'])->name('index');
            Route::get('/{subject}', [ProfessorSubjectController::class, 'view'])->name('view');
            Route::post('/{subject}', [ProfessorSubjectController::class, 'update'])->name('update');
            Route::get('/{subject}/students', [ProfessorStudentController::class, 'getStudents'])->name('students');
            Route::get('/{subject}/students/{user}/result', [ProfessorStudentController::class, 'getResultOfSubject'])
                ->name('get-result-of-subject');
            Route::post('/{subject}/students/{user}/result', [
                ProfessorStudentController::class,
                'updateResultOfSubject',
            ])->name('update-result-of-subject');
            Route::get('/{subject}/lectures', [ProfessorLectureController::class, 'index'])->name('lectures');


        });
        Route::name('lectures.')->prefix('/lecture')->group(function () {

            Route::get('/{lecture}/attendants', [ProfessorLectureController::class, 'getAllAttendants'])
                ->name('lectures');
            Route::get('/{lecture}/all-students', [ProfessorLectureController::class, 'getAllStudents'])
                ->name('lectures');
            Route::post('/{lecture}/update-attendance-state/{user}', [ProfessorLectureController::class, 'updateAttendance'])
                ->name('lectures');
        });


    });


    Route::prefix('/student')->name('student.')->group(function () {
        Route::prefix('/subjects')->name('subjects.')->group(function () {
            Route::get('/', [StudentSubjectController::class, 'index'])->name('index');
            Route::get('/{subject}', [StudentSubjectController::class, 'view'])->name('get-result');
            Route::get('/{subject}/result', [StudentSubjectController::class, 'getResult'])->name('get-result');
            Route::get('/{subject}/lectures', [StudentSubjectController::class, 'getLectures'])->name('lectures');
        });

        Route::prefix('/professors')->name('professors.')->group(function () {
            Route::get('/', [StudentProfessorController::class, 'index'])->name('index');
            Route::get('/{user}', [StudentProfessorController::class, 'view'])->name('view');
            Route::get('/{user}/subjects', [StudentProfessorController::class, 'getSubjects'])->name('subjects');
        });


    });
});


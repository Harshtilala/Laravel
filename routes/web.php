<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
Route::get('student-list',[StudentController::class,'index'])->name('student.list');
Route::get('student-create',[StudentController::class,'create'])->name('student.create');
Route::post('student-insert',[StudentController::class,'store'])->name('student.store');
Route::get('student-edit/{id}',[StudentController::class,'edit'])->name('student.edit');
Route::put('student-update/{id}',[StudentController::class,'update'])->name('student.update');
Route::delete('/student/delete/{id}', [StudentController::class, 'destroy'])->name('student.destroy');

Route::get('contact-insert',[ContactController::class,'store'])->name('contact.store');

Route::get('/classes', [ClassesController::class, 'index'])->name('classes.index');
Route::get('/classes/create', [ClassesController::class, 'create'])->name('classes.create');
Route::post('/classes/store', [ClassesController::class, 'store'])->name('classes.store');
Route::get('/classes/{id}/edit', [ClassesController::class, 'edit'])->name('classes.edit');
Route::put('/classes/{id}/update', [ClassesController::class, 'update'])->name('classes.update');
Route::delete('/classes/{id}', [ClassesController::class, 'destroy'])->name('classes.delete');

Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
Route::post('/subjects/store', [SubjectController::class, 'store'])->name('subjects.store');
Route::get('/subjects/{id}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
Route::put('/subjects/{id}/update', [SubjectController::class, 'update'])->name('subjects.update');
Route::delete('/subjects/{id}', [SubjectController::class, 'destroy'])->name('subjects.delete');
});
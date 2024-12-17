<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Route::view('/form', 'form');

Route:: get('/',[StudentController::class, 'index'])->name('home');
Route:: post('/',[StudentController::class, 'store'])->name('form-submit');
Route::get('/record-delete/{id}',[StudentController::class, 'destroy'])->name('delete');
// Route::get('update/{id}', [StudentController::class, 'edit'])->name('Student.update');
Route::post('/delete-attachment/delete/{id}/{file}', [StudentController::class, 'deleteAttachment'])->name('delete-attachment');


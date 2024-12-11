<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Route::view('/form', 'form');

Route:: get('/',[StudentController::class, 'index'])->name('home');
Route:: post('/',[StudentController::class, 'store'])->name('form-submit');

Route::get('/record-delete/{id}',[StudentController::class, 'destroy'])->name('delete');
    
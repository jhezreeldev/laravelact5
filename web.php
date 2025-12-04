<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Registration and Summary Routes
|--------------------------------------------------------------------------
*/

// Route to show the Registration Form
Route::get('/register', [RegistrationController::class, 'showForm'])->name('register.form');

// Route to handle the form submission and validation (POST)
Route::post('/register', [RegistrationController::class, 'submitForm'])->name('register.submit');

// Route to show the Summary (Index) page
Route::get('/summary', [StudentController::class, 'index'])->name('students.index');

/*
|--------------------------------------------------------------------------
| Student Management (CRUD) Routes
|--------------------------------------------------------------------------
*/

// Using a Resource route for the Edit and Delete functionality
// Ito ang nagbibigay ng students.edit at students.destroy routes.
Route::resource('students', StudentController::class)->except(['index', 'show', 'create', 'store']);

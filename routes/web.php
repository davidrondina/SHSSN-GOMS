<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentRegistrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::middleware(['guest'])->prefix('register')->as('student-register.')->group(function () {
    Route::post('/submit', [StudentRegistrationController::class, 'store'])->name('store');
    Route::post('/verify-account', [StudentRegistrationController::class, 'verifyAccount'])->name('verify-account');
    Route::post('/verify-student', [StudentRegistrationController::class, 'verifyStudentInfo'])->name('verify-student');
    Route::post('/verify-guardian', [StudentRegistrationController::class, 'verifyGuardianInfo'])->name('verify-guardian');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

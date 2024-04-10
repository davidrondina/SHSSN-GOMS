<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\StrandController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\StudentRegistrationController;
use App\Http\Controllers\Admin\UnverifiedUserController;
use App\Http\Controllers\Admin\DashboardController as ADDashboardController;
use App\Http\Controllers\Counselor\DashboardController as CODashboardController;

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
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['role:admin'])->prefix('admin')->as('admin.')->group(function () {
        Route::get('/dashboard', [ADDashboardController::class, 'index'])->name('dashboard');

        Route::resource('academic-years', AcademicYearController::class);
        Route::resource('strands', StrandController::class)->except(['show']);
        Route::resource('departments', DepartmentController::class);
        Route::resource('faculties', FacultyController::class);
        Route::prefix('faculties')->as('faculties.')->group(function () {
            Route::put('/{id}/subjects', [FacultyController::class, 'updateSubjects'])->name('subjects');
        });
        Route::resource('subjects', SubjectController::class);
        Route::resource('sections', SectionController::class);
        Route::prefix('sections')->as('sections.')->group(function () {
            Route::put('/{id}/students', [SectionController::class, 'updateStudents'])->name('students');
            Route::put('/{id}/subjects', [SectionController::class, 'updateSubjects'])->name('subjects');
        });
        Route::resource('students', StudentController::class);
        Route::prefix('students')->as('students.')->group(function () {
            Route::post('/{id}/enroll', [StudentController::class, 'enrollToCurrentYear'])->name('enroll');
        });
        Route::prefix('unverified-users')->as('unverified-users.')->group(function () {
            Route::get('/', [UnverifiedUserController::class, 'index'])->name('index');
            Route::get('/{id}', [UnverifiedUserController::class, 'show'])->name('show');
            Route::post('/{id}/approve', [UnverifiedUserController::class, 'approve'])->name('approve');
            Route::delete('/{id}/reject', [UnverifiedUserController::class, 'reject'])->name('reject');
            Route::delete('/{id}', [UnverifiedUserController::class, 'destroy'])->name('destroy');
        });
    });

    Route::middleware(['role:counselor'])->prefix('counselor')->as('counselor.')->group(function () {
        Route::get('/dashboard', [CODashboardController::class, 'index'])->name('dashboard');
    });
});

require __DIR__ . '/auth.php';

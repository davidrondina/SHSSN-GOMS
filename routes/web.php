<?php

use App\Mail\AppointmentNotice;
use App\Models\Student; // Testing
use App\Models\Guardian; // testing
use App\Mail\UserVerificationFailed;
use App\Mail\DocumentSent; // Testing
use App\Mail\UserVerificationSuccess;
use Illuminate\Support\Facades\Route;
use App\Models\Appointment; // Testing
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\StrandController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\DocumentGuideController;
use App\Http\Controllers\Faculty\ClassController;
use App\Http\Controllers\Student\ServiceController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Faculty\AdvisoryController;
use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\VerifiedUserController;
use App\Http\Controllers\StudentRegistrationController;
use App\Http\Controllers\Admin\UnverifiedUserController;
use App\Http\Controllers\DocumentFormController; // Remove
use App\Http\Controllers\Admin\StudentController as ADStudentController;
use App\Http\Controllers\Faculty\StudentController as FAStudentController;
use App\Http\Controllers\Admin\DashboardController as ADDashboardController;
use App\Http\Controllers\Faculty\ComplaintController as FAComplaintController;
use App\Http\Controllers\Faculty\DashboardController as FADashboardController;
use App\Http\Controllers\Student\ComplaintController as STComplaintController;
use App\Http\Controllers\Student\DashboardController as STDashboardController;
use App\Http\Controllers\Counselor\ComplaintController as COComplaintController;
use App\Http\Controllers\Counselor\DashboardController as CODashboardController;
use App\Http\Controllers\Admin\UserFeedbackController as ADUserFeedbackController;
use App\Http\Controllers\Student\AppointmentController as STAppointmentController;
use App\Http\Controllers\Admin\DocumentGuideController as ADDocumentGuideController;
use App\Http\Controllers\Counselor\AppointmentController as COAppointmentController;
use App\Http\Controllers\Student\UserFeedbackController as STUserFeedbackController;

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
    Route::get('/success', [StudentRegistrationController::class, 'success'])->name('success');
});

Route::get('/file/download', [DocumentController::class, 'index'])->middleware(['document_link_is_valid'])->name('download-file');

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
        Route::resource('guides', ADDocumentGuideController::class)->except(['index', 'create', 'store', 'destroy']);
        Route::resource('subjects', SubjectController::class);
        Route::resource('sections', SectionController::class);
        Route::prefix('sections')->as('sections.')->group(function () {
            Route::put('/{id}/students', [SectionController::class, 'updateStudents'])->name('students');
            Route::put('/{id}/subjects', [SectionController::class, 'updateSubjects'])->name('subjects');
        });
        Route::prefix('reports')->as('reports.')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('index');
            Route::get('/generate', [ReportController::class, 'create'])->name('create');
        });
        // Route::resource('reports', ReportController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('students', ADStudentController::class);
        Route::prefix('students')->as('students.')->group(function () {
            Route::post('/{id}/enroll', [ADStudentController::class, 'enrollToCurrentYear'])->name('enroll');
        });
        Route::prefix('users')->as('users.')->group(function () {
            Route::prefix('verified')->as('verified.')->group(function () {
                Route::get('/', [VerifiedUserController::class, 'index'])->name('index');
                Route::delete('/{id}', [VerifiedUserController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('unverified')->as('unverified.')->group(function () {
                Route::get('/', [UnverifiedUserController::class, 'index'])->name('index');
                Route::get('/{id}', [UnverifiedUserController::class, 'show'])->name('show');
                Route::post('/{id}/approve', [UnverifiedUserController::class, 'approve'])->name('approve');
                Route::patch('/{id}/reject', [UnverifiedUserController::class, 'reject'])->name('reject');
                Route::delete('/{id}', [UnverifiedUserController::class, 'destroy'])->name('destroy');
            });
        });
        Route::resource('feedback', ADUserFeedbackController::class)->except(['show', 'create', 'store', 'edit', 'update', 'destroy']);
    });

    Route::middleware(['role:counselor'])->prefix('counselor')->as('counselor.')->group(function () {
        Route::get('/dashboard', [CODashboardController::class, 'index'])->name('dashboard');

        Route::resource('appointments', COAppointmentController::class);
        Route::prefix('appointments')->as('appointments.')->group(function () {
            Route::post('/notify', [COAppointmentController::class, 'notify'])->name('notify');
        });
        Route::resource('complaints', COComplaintController::class);
        Route::prefix('complaints')->as('complaints.')->group(function () {
            Route::patch('/{id}/close', [COComplaintController::class, 'close'])->name('close');
        });
    });

    Route::middleware(['role:faculty'])->prefix('faculty')->as('faculty.')->group(function () {
        Route::get('/dashboard', [FADashboardController::class, 'index'])->name('dashboard');
        Route::prefix('advisory')->as('advisory.')->group(function () {
            Route::get('/current', [AdvisoryController::class, 'current'])->name('current');
        });
        Route::resource('advisory', AdvisoryController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('students', FAStudentController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('complaints', FAComplaintController::class);
        Route::resource('classes', ClassController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);
    });

    Route::middleware(['role:student'])->prefix('student')->as('student.')->group(function () {
        Route::get('/dashboard', [STDashboardController::class, 'index'])->name('dashboard');
        Route::resource('appointments', STAppointmentController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('offenses', STComplaintController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('services', ServiceController::class)->except(['edit', 'update', 'destroy']);
        Route::post('/feedback', [STUserFeedbackController::class, 'store'])->name('feedback.store');
    });

    Route::get('/guides', [DocumentGuideController::class, 'index'])->name('document-guide.index');

    // TEST ROUTES: DELETE ONCE IN PRODUCTION

    // Route::get('/gm', function () {
    //     return view('documents.good-moral');
    // });

    Route::get('/gm', [DocumentFormController::class, 'goodMoral']);

    Route::get('/mail', function () {
        $appointment = Appointment::findOrFail(1);
        $guardian = Guardian::findOrFail(6);
        $student = Student::findOrFail(6);

        return (new AppointmentNotice($appointment, $guardian, $student))->render();

        // $reason = 'Invalid Image Proof';
        // $additional_comment = 'Avoid using non-related image';

        // return (new AppointmentNotice())->render();

        // $user = Auth::user();
        // $student = $user->studentInfo;

        // return (new UserVerificationSuccess($user, $student))->render();

        // $document = App\Models\DocumentLink::find(1);

        // return (new DocumentSent($user, $document))->render();
    });

    // Route::get('/email-test', function () {
    //     $type = 'Good Moral';

    //     // The email sending is done using the to method on the Mail facade
    //     Mail::to('testreceiver@gmail.com')->send(new DocumentSent($type));
    // });
});

require __DIR__ . '/auth.php';

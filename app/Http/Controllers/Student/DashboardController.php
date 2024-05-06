<?php

namespace App\Http\Controllers\Student;

use App\Models\AcademicYear;
use App\Models\DocumentAcquisition;
use Carbon\Carbon;
use App\Models\Section;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $current_year = AcademicYear::where('is_current', true)->first();

        $acquisitions = $user->acquisitions;

        $upcoming_apps = Appointment::whereHas(
            'complaint',
            function ($query) use ($user) {
                $query->where('student_id', $user->studentInfo->id);
            }
        )->whereDate('start_date', '>=', Carbon::now())->get();

        $offenses = $user->studentInfo->complaintsReceived();

        $current_section = Section::whereHas('students', function ($query) use ($user) {
            $query->where('student_id', $user->studentInfo->id);
        })->where('academic_year_id', $current_year->id)->latest()->first();

        // dd($acquisitions->count(), $offenses->count(), $current_section, $upcoming_apps);

        return view('users.student.dashboard', compact(['acquisitions', 'current_section', 'current_year', 'offenses', 'upcoming_apps', 'user']));
    }
}

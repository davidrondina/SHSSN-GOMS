<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Subject;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\DocumentAcquisition;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $year = AcademicYear::where('is_current', true)->first();
        $enrolled_students_count = $year->enrolledStudents->count();
        $sections_count = $year->sections->count();
        $students_count = Student::count();
        $subjects_count = Subject::count();
        $faculties_count = Faculty::count();
        $users_count = User::role(['counselor', 'faculty', 'student'])->count();

        // For total cases chart
        $prev_months = [];
        $month_names = [];

        /*
         * Get all the names of the previous 4 months
         * Where $i is the number of previous month (e.g. 3 means 4 previous months)
         */
        for ($i = 3; $i >= 0; $i--) {
            $month = Carbon::today()->startOfMonth()->subMonths($i);
            $month_name = $month->shortMonthName;
            $full_year = Carbon::today()->startOfMonth()->subMonths($i)->format('Y');

            array_push(
                $prev_months,
                array(
                    'month' => $month,
                    'year' => $full_year
                )
            );

            array_push($month_names, $month_name . '. ' . $full_year);
        }

        // Get all cases created over the past 4 months
        $acquisitions = [];

        foreach ($prev_months as $month) {
            $data = DocumentAcquisition::whereMonth('created_at', $month['month'])->whereYear('created_at', $month['year']);
            // dd($data);
            // if ($month['month']->shortMonthName == 'Apr') {
            //     dd($complaints, $month['month']);
            // }

            array_push($acquisitions, $data->count());
        }

        return view('users.admin.dashboard', compact(['acquisitions', 'enrolled_students_count', 'faculties_count', 'month_names', 'sections_count', 'subjects_count', 'students_count', 'users_count', 'year']));
    }
}

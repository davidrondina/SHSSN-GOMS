<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Strand;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Department;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\EnrolledStudent;
use App\Models\DocumentAcquisition;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.admin.reports.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $report = $request->report;

        switch ($report) {
            case 'dashboard':
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

                return view('users.admin.reports.create', compact(['acquisitions', 'enrolled_students_count', 'faculties_count', 'month_names', 'sections_count', 'subjects_count', 'students_count', 'users_count', 'report', 'year']));
                break;

            case 'enrolled-students':
                $current_year = AcademicYear::where('is_current', true)->first();
                $students = EnrolledStudent::where('academic_year_id', $current_year->id)->whereHas('student', function ($query) {
                    $query->where('id', '>', 0)->orderBy('surname');
                });

                $strands = Strand::get();

                $strand_names = Strand::pluck('abbr')->toArray();

                $students_by_strand = [];
                $students_count = [];

                foreach ($strands as $str) {
                    array_push($students_by_strand, (
                        array(
                            'name' => $str->abbr,
                            'count' => $students->where('strand_id', $str->id)->count(),
                        )
                    ));

                    array_push($students_count, $students->where('strand_id', $str->id)->count());
                }

                $students_by_grade_level = [
                    '11' => EnrolledStudent::where('academic_year_id', $current_year->id)->where('grade_level', '11')->count(),
                    '12' => EnrolledStudent::where('academic_year_id', $current_year->id)->where('grade_level', '12')->count(),
                ];

                $students = EnrolledStudent::where('academic_year_id', $current_year->id)->whereHas('student', function ($query) {
                    $query->where('id', '>', 0)->orderBy('surname');
                })->orderBy('grade_level')->get();

                // dd($current_year, $strand_names, $students, $students_by_grade_level, $students_by_strand);

                return view('users.admin.reports.create', compact(['current_year', 'strand_names', 'students', 'students_count', 'students_by_grade_level', 'students_by_strand', 'report']));

                break;

            case 'faculties':
                $departments = Department::get();
                $faculties_by_dept = array();
                $dept_names = Department::pluck('name')->toArray();

                foreach ($departments as $dept) {
                    $facs = $dept->faculties;
                    // dd($dept->name, $facs->count());
                    array_push($faculties_by_dept, $facs->count());
                }

                $faculties = Faculty::whereHas('user', function ($query) {
                    $query->with('profile')->whereHas('profile', function ($query) {
                        $query->where('id', '>', 0)->orderBy('surname');
                    });
                })->with('user')->get();

                // dd($faculties);

                return view('users.admin.reports.create', compact(['dept_names', 'faculties', 'faculties_by_dept', 'report']));
                break;

            default:
                # code...
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

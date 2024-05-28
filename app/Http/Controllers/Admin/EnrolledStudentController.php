<?php

namespace App\Http\Controllers\Admin;

use App\Models\Strand;
use App\Models\Student;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\EnrolledStudent;
use App\Http\Controllers\Controller;

class EnrolledStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $year = AcademicYear::where('is_current', true)->first();
        $strands = Strand::orderBy('abbr')->get();
        $students = Student::whereDoesntHave('enrolments', function ($query) use ($year) {
            $query->where('academic_year_id', $year->id);
        })->get();

        // dd($students);

        return view('users.admin.enrolled-students.create', compact(['strands', 'students', 'year']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $students = $request->students;

        foreach ($students as $stu) {
            $student = EnrolledStudent::create([
                'student_id' => $stu,
                'academic_year_id' => $request->year_id,
                'strand_id' => $request->strand,
                'grade_level' => $request->grade_level,
            ]);
        }

        return back()->with('success_message', 'Students has been enrolled successfully');
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

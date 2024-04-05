<?php

namespace App\Http\Controllers\Admin;

use App\Models\SectionSubject;
use App\Models\Strand;
use App\Models\Faculty;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Department;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\FacultySubject;
use App\Models\EnrolledStudent;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    private $strands;

    public function __construct()
    {
        $this->strands = Strand::orderBy('abbr')->get();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $strands = $this->strands;
        $sections = Section::with('academicYear')->get();
        // dd($sections);

        return view('users.admin.sections.index', compact(['sections', 'strands']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $year = AcademicYear::where('is_current', true)->first();
        $strands = $this->strands;
        $departments = Department::with('faculties')->get();
        $students = $year->enrolledStudents;
        $fac_with_subjects = FacultySubject::with('faculty', 'subject')->get();

        return view('users.admin.sections.create', compact(['strands', 'departments', 'year', 'students', 'fac_with_subjects']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'adviser' => ['required'],
            'strand' => ['required'],
        ]);

        $section = Section::create([
            'adviser_id' => $request->adviser,
            'academic_year_id' => $request->year,
            'strand_id' => $request->strand,
            'name' => $request->name,
            'grade_level' => $request->grade_level,
        ]);

        if ($request->students) {
            foreach ($request->students as $key => $value) {
                $section->students()->attach($value);
            }
        }

        if ($request->subjects) {
            foreach ($request->subjects as $key => $value) {
                SectionSubject::create([
                    'section_id' => $section->id,
                    'faculty_subject_id' => $value
                ]);
            }
        }

        return redirect(route('admin.sections.index'))->with('success_message', 'Section has been added successfully.');
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

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
        $sections = Section::whereHas('academicYear', function ($query) {
            $query->where('is_current', true);
        })->orderBy('name')->get();
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
                $fac_subject = FacultySubject::find($value);

                SectionSubject::create([
                    'section_id' => $section->id,
                    'subject_id' => $fac_subject->subject_id,
                    'faculty_id' => $fac_subject->faculty_id,
                ]);

                // SectionSubject::create([
                //     'section_id' => $section->id,
                //     'faculty_subject_id' => $value
                // ]);
            }
        }

        return redirect(route('admin.sections.index'))->with('success_message', 'Section has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $year = AcademicYear::where('is_current', true)->first();
        $section = Section::find($id);
        // $fac_with_subjects = FacultySubject::whereDoesntHave('sectionSubjects', function ($query) use ($section) {
        //     $query->where('section_id', $section->id);
        // })->get();
        $subjects = $section->subjects;
        $students = $year->enrolledStudents;
        $sec_subjects = SectionSubject::get();
        $fac_with_subjects = FacultySubject::with('faculty', 'subject')->get();

        // dd($subjects, $students, $sec_subjects->pluck('faculty_id'), $fac_with_subjects);

        return view('users.admin.sections.show', compact(['section', 'subjects', 'students', 'fac_with_subjects', 'sec_subjects']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    // TODO: Update section students based on the students array
    public function updateStudents(Request $request, string $id)
    {
        dd($request->all());
    }

    // TODO: Update section subjects based on the subjects array
    public function updateSubjects(Request $request, string $id)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Strand;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\EnrolledStudent;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    private $currentAY;
    private $strands;

    public function __construct()
    {
        $this->currentAY = AcademicYear::where('is_current', true)->first();
        $this->strands = Strand::orderBy('abbr')->get();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $year = $this->currentAY;
        $strands = $this->strands;
        $students = Student::orderBy('surname')->paginate(30)->withQueryString();

        if ($request->view === 'enrolled') {
            $students = Student::whereHas('enrolments', function ($query) {
                $query->whereHas('academicYear', function ($query) {
                    $query->where('is_current', true);
                });
            })->orderBy('surname')->paginate(30)->withQueryString();
        } else if ($request->view === 'notenrolled') {
            $students = Student::whereDoesntHave('enrolments', function ($query) {
                $query->whereHas('academicYear', function ($query) {
                    $query->where('is_current', true);
                });
            })->orderBy('surname')->paginate(30)->withQueryString();
        }

        return view('users.admin.students.index', compact(['students', 'year', 'strands']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.admin.students.create');
    }

    public function enrollToCurrentYear(Request $request, string $id)
    {
        $year = $this->currentAY;
        $student = Student::find($id);

        $request->validate(['grade_level' => 'required']);

        EnrolledStudent::create([
            'student_id' => $id,
            'academic_year_id' => $year->id,
            'grade_level' => $request->grade_level,
        ]);

        return back()->with('success_message', 'Student successfully enrolled');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all(), $request->has('enroll_student'));

        $year = $this->currentAY;

        $request->validate([
            'lrn' => ['required', 'numeric', 'max_digits:12', 'unique:students,lrn'],
            'student_first_name' => ['required', 'regex:/^[\pL\s]+$/u', 'max:60'], // Regex to accept only alpha chars and whitespaces
            'student_middle_name' => ['nullable', 'regex:/^[\pL\s]+$/u', 'max:60',],
            'student_surname' => ['required', 'regex:/^[\pL\s]+$/u', 'max:60'],
            'address' => ['required', 'string', 'max:90'],
            'sex' => ['required'],
            'birthdate' => ['required', 'date'],
            'student_phone_no' => ['required', 'numeric', 'max_digits:11'],
            'guardian_email' => ['nullable', 'email', 'max:60'],
            'guardian_first_name' => ['required', 'regex:/^[\pL\s]+$/u'],
            'guardian_middle_name' => ['nullable', 'regex:/^[\pL\s]+$/u', 'max:60'],
            'guardian_surname' => ['required', 'regex:/^[\pL\s]+$/u'],
            'guardian_phone_no' => ['required', 'numeric', 'max_digits:11'],
        ]);

        $guardian_fields = [
            'first_name' => $request->guardian_first_name,
            'middle_name' => $request->guardian_middle_name ?? null,
            'surname' => $request->guardian_surname,
            'suffix' => $request->guardian_suffix ?? null,
            'birthdate' => $request->birthdate,
            'email' => $request->guardian_email,
            'phone_no' => $request->guardian_phone_no ?? null,
        ];

        $registered_guardian = Guardian::create($guardian_fields);

        $student_fields = [
            'guardian_id' => $registered_guardian->id,
            'lrn' => $request->lrn,
            'first_name' => $request->student_first_name,
            'middle_name' => $request->student_middle_name ?? null,
            'surname' => $request->student_surname,
            'suffix' => $request->student_suffix ?? null,
            'birthdate' => $request->birthdate,
            'address' => $request->address,
            'sex' => $request->sex,
            'phone_no' => $request->student_phone_no ?? null,
        ];

        $registered_student = Student::create($student_fields);

        if ($request->has('enroll_student')) {
            if ($request->grade_level) {
                EnrolledStudent::create([
                    'student_id' => $registered_student->id,
                    'academic_year_id' => $year->id,
                    'grade_level' => $request->grade_level,
                ]);
            }
        }

        return to_route('admin.students.index')->with('success_message', 'Student & guardian record created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);

        return view('users.admin.students.show', compact(['student']));
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

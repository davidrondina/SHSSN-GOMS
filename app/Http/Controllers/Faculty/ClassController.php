<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Section;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\SectionSubject;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    private $current_year;

    public function __construct()
    {
        $this->current_year = AcademicYear::where('is_current', true)->first();
    }

    /**
     * Display a listing of the resource.
     */

    //  TODO: Handle record filtering
    public function index()
    {
        $auth_user = Auth::user();
        $faculty = $auth_user->facultyInfo;
        $fac_subjects = $faculty->subjects;
        $year = $this->current_year;
        // $fac_classes = Section::with([
        //     'academicYear' =>
        //         function ($query) use ($year) {
        //             $query->where('id', $year->id);
        //         },
        //     'subjects' =>
        //         function ($query) use ($faculty) {
        //             $query->whereHas('faculty', function ($query) use ($faculty) {
        //                 $query->where('id', $faculty->id);
        //             });
        //         }
        // ])->orderBy('name')->get();

        $fac_classes = SectionSubject::with([
            'faculty' =>
                function ($query) use ($faculty) {
                    $query->where('id', $faculty->id);
                },
            'section' =>
                function ($query) use ($year) {
                    $query->whereRelation('academicYear', 'id', '=', $year->id);
                }
        ])->get();

        // dd($fac_classes);

        return view('users.faculty.classes.index', compact(['faculty', 'fac_classes', 'fac_subjects', 'year']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $section = Section::find($id);
        $subjects = $section->subjects;

        return view('users.faculty.advisory.show', compact(['section', 'subjects']));
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

<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Section;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdvisoryController extends Controller
{
    private $current_year;

    public function __construct()
    {
        $this->current_year = AcademicYear::where('is_current', true)->first();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth_user = Auth::user();
        $faculty = $auth_user->facultyInfo;
        $current_advisory = $faculty->advisorySections->where('academic_year_id', $this->current_year->id)->first();
        $prev_advisories = Section::where('adviser_id', $faculty->id)->whereHas('academicYear', function ($query) {
            $query->whereNot('is_current', true);
        })->latest()->paginate(30)->withQueryString();
        $year = $this->current_year;

        return view('users.faculty.advisory.index', compact(['current_advisory', 'year', 'prev_advisories']));
    }

    public function current()
    {
        $auth_user = Auth::user();
        $faculty = $auth_user->facultyInfo;
        $section = $faculty->advisorySections->where('academic_year_id', $this->current_year->id)->first();
        $subjects = $section->subjects;

        return view('users.faculty.advisory.show', compact(['section', 'subjects']));
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

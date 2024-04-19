<?php

namespace App\Http\Controllers\Admin;

use Closure;
use App\Models\Strand;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcademicYearController extends Controller
{
    private $currentAY;

    public function __construct()
    {
        $this->currentAY = AcademicYear::where('is_current', true)->first();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academic_years = AcademicYear::whereNot('is_current', true)->latest()->paginate(30)->withQueryString();

        return view('users.admin.academic-years.index', compact(['academic_years']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.admin.academic-years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => [
                'required',
                'date',
                'before:end_date',
                function (string $attribute, mixed $value, Closure $fail) {
                    $starting_years = AcademicYear::get();
                    $starting_years = $starting_years->pluck('start')->toArray();

                    foreach ($starting_years as $year) {
                        if ($year > date('Y', strtotime($value))) {
                            $fail("The {$attribute} must be greater than other existing starting date.");
                        }
                    }
                }
            ],
            'end_date' => ['required', 'date', 'after:start_date']
        ]);

        // Archive current AY and create new one and set it as current
        $this->currentAY->update(['is_current' => false]);

        AcademicYear::create([
            'start' => date('Y', strtotime($request->start_date)),
            'end' => date('Y', strtotime($request->end_date)),
            'is_current' => true
        ]);

        return to_route('admin.academic-years.index')->with('success_message', 'Academic year has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $year = AcademicYear::find($id);
        $sections = $year->sections;
        $sections = $sections->paginate(30)->withQueryString();
        $strands = Strand::orderBy('abbr')->get();

        return view('users.admin.academic-years.show', compact(['sections', 'year', 'strands']));
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

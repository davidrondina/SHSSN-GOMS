<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faculty;
use App\Models\Department;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::orderBy('name')->get();
        $faculties = Faculty::get();

        return view('users.admin.faculties.index', compact(['faculties', 'departments']));
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
        $faculty = Faculty::find($id);
        $subjects = Subject::orderBy('name')->get();

        return view('users.admin.faculties.show', compact(['faculty', 'subjects']));
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

    public function updateSubjects(Request $request, string $id)
    {
        $faculty = Faculty::findOrFail($id);
        $request->validate(['subjects' => 'required']);

        $faculty->subjects()->sync($request->subjects);

        return back()->with('success_message', 'Faculty subjects updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
